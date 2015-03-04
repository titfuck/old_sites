import flash.geom.*;
import flash.external.*;
import flash.filters.*;

class Picture 
{
	static function main(mc)
	{
		Stage.align = "TL";
		Stage.scaleMode = "noScale";



		var createClip = function(parent)
		{
			return parent.createEmptyMovieClip(
				"clip_" + Math.round(100000*Math.random()), 
				parent.getNextHighestDepth()
			);
		}

		var makeHigher = function(clip1, clip2)
		{
			if (clip1.getDepth() < clip2.getDepth())
				clip1.swapDepths(clip2);
		}

		var addRollOver = function(clip, valueOff, valueOn, callback)
		{
			clip.onRollOver = function() { callback(valueOn); }
			var unhighlight = function() { callback(valueOff); }			
			clip.onRollOut = clip.onDragOut = unhighlight;
			unhighlight();
		}


		var center = createClip(_root);
		var map = createClip(center);
		var tileArea = createClip(map);
		var linksArea = createClip(map);
		var transitionArea = createClip(center);
		var nav, x, y, z, maxZ, boundZ;
		var wasMapDrag;


		var control = {
			urlPrefix: "",
			getFirstID: function() { return ExternalInterface.call("getFirstID"); },
			getNavEnabled: function() { return ExternalInterface.call("navEnabled"); },
			loadNav: function(id, dontPushHistory) { return ExternalInterface.call("loadNav", id, dontPushHistory); }
		};

		if (_root.id)
		{
			_root.beginFill(0xffffff, 100);
			_root.moveTo(0, 0);
			_root.lineTo(Stage.width, 0);
			_root.lineTo(Stage.width, Stage.height);
			_root.lineTo(0, Stage.height);
			_root.endFill();

			_root.createTextField("tf", _root.getNextHighestDepth(), 0, 0, 0, 20);
			var tf = _root.tf;
			tf.selectable = false;
			tf.autoSize = "left";
			var fmt = new TextFormat();
			fmt.size = 14;
			fmt.font = "Arial";
			fmt.align = "left";
			fmt.color = 0xffffff;
			tf.setNewTextFormat(fmt);
			tf.filters = [new DropShadowFilter(1, 45, 0x000000, 1, 0, 0, 1)];
			tf._x = 0;
			tf._y = Stage.height - 20;
			tf.html = true;

			var base64Encode = function(data)
			{
				var b64_map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-()';
				var byte1, byte2, byte3;
				var ch1, ch2, ch3, ch4;
				var result = [];
				var j = 0;
				for (var i = 0; i < data.length; i += 3) 
				{
					byte1 = data.charCodeAt(i);
					byte2 = data.charCodeAt(i+1);
					byte3 = data.charCodeAt(i+2);
					ch1 = byte1 >> 2;
					ch2 = ((byte1 & 3) << 4) | (byte2 >> 4);
					ch3 = ((byte2 & 15) << 2) | (byte3 >> 6);
					ch4 = byte3 & 63;
		
					if (isNaN(byte2))
						ch3 = ch4 = 64;
					else if (isNaN(byte3))
						ch4 = 64;

					result[j++] = b64_map.charAt(ch1) + b64_map.charAt(ch2) + b64_map.charAt(ch3) + b64_map.charAt(ch4);
				}

				return result.join('');
			}

			var base64Decode = function(data)
			{
				var b64_map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-()';
				var byte1, byte2, byte3;
				var ch1, ch2, ch3, ch4;
				var result = [];
				var j = 0;
				while ((data.length%4) != 0)
					data += '=';
	
				for (var i = 0; i < data.length; i += 4) 
				{
					ch1 = b64_map.indexOf(data.charAt(i));
					ch2 = b64_map.indexOf(data.charAt(i+1));
					ch3 = b64_map.indexOf(data.charAt(i+2));
					ch4 = b64_map.indexOf(data.charAt(i+3));

					byte1 = (ch1 << 2) | (ch2 >> 4);
					byte2 = ((ch2 & 15) << 4) | (ch3 >> 2);
					byte3 = ((ch3 & 3) << 6) | ch4;

					result[j++] = String.fromCharCode(byte1);
					if (ch3 != 64) result[j++] = String.fromCharCode(byte2);
					if (ch4 != 64) result[j++] = String.fromCharCode(byte3);	
				}

				return result.join('');
			}

			control = {
				urlPrefix: "http://openphotovr.org/",
				getFirstID: function() { return _root.id; },
				getNavEnabled: function() { return true; },
				loadNav: function(id, dontPushHistory)
				{
					var xml = new XML();
					xml.onData = function(data)
					{
						var newNav = (new JSON()).parse(data.substring(4, data.length - 2));
						control.setNavigationInfo(newNav);
						var desc = newNav.description;
						tf.htmlText = ""; // (desc && (desc != "")) ? base64Decode(desc) : "";
					}
					xml.load(control.urlPrefix + "data/" + id + "/nav.js");
				}
			}
		}


		var tiles = {};

		var constrain = function(a, t, b) { return (t < a) ? a : (t > b) ? b : t; }
		var interpolate = function(a, t, b) { return constrain(a, a + t*(b - a), b); }
		var shift = function(a, t, b) { return constrain(0, (t - a)/(b - a), 1); }

		var loadQueue = [];
		var loadInProgress = false;
		var loadNext;
		loadNext = function(loadFinished)
		{
			if (loadFinished)
				loadInProgress = false;
			if ((!loadInProgress) && (loadQueue.length > 0))
			{
				loadInProgress = true;
				if (!loadQueue.shift().load())
					loadNext(true);
			}
		}

		var addTile = function(url, minx, miny, scale)
		{
			if (tiles[url])
				return;

			var clip = createClip(tileArea);
			var img = createClip(clip);
			var unloaded = false, loading = false, loaded = false;
			var tile;
			tile = {
				url: url,
				load: function()
				{
					if (!tiles[url])
						tile.unload();

					if (unloaded)
						return false;
					
					var loader = new MovieClipLoader();
					loader.addListener({
						onLoadInit: function(mmc)
						{
							if (unloaded)
								clip.removeMovieClip();
							else
								clip.transform.matrix = new Matrix(scale, 0, 0, scale, minx, miny);
							loaded = true;
							loading = false;
							loadNext(true);
						},
						onLoadError: function()
						{
							loaded = true;
							loading = false;
							loadNext(true);
						}
					});
					loading = true;
					loader.loadClip(url, img);	
					return true;
				},
				unload: function()
				{
					if (unloaded)
						return;
					unloaded = true;
					if (!loading)
						clip.removeMovieClip();
				}
			};
			tiles[url] = tile;
			loadQueue.push(tile);
			loadNext(false);
		}

		var transitionCleanup = false;

		var addTile2 = function(url, minx, miny, scale)
		{
			if (tiles[url])
				return;

			var clip = createClip(tileArea);
			var img = createClip(clip);
			var unloaded = false, loaded = false;

			var loader = new MovieClipLoader();
			loader.addListener({
				onLoadInit: function(mmc)
				{
					if (transitionCleanup)
					{
						transitionCleanup();
						transitionCleanup = false;
					}

					if (unloaded)
						clip.removeMovieClip();
					else
						clip.transform.matrix = new Matrix(scale, 0, 0, scale, minx, miny);
					loaded = true;
				},
				onLoadError: function()
				{
					loaded = true;
				}
			});
			loader.loadClip(url, img);	

			var tile = {
				url: url,
				unload: function()
				{
					if (unloaded)
						return;
					unloaded = true;
					if (loaded)
						clip.removeMovieClip();
					else
						loader.unloadClip(img);
				}
			};

			tiles[url] = tile;
		}

		var addTiles = function(z_, adderFunc)
		{
			var inv = map.transform.matrix.clone();
			inv.invert();
			var p1 = inv.transformPoint(new Point(-Stage.width/2, -Stage.height/2));
			var p2 = inv.transformPoint(new Point(Stage.width/2, Stage.height/2));

			var integerZ = Math.floor(z_);
			var tileSize = 256*Math.pow(2, integerZ);
			var i1 = Math.floor(constrain(0, p1.x, nav.width)/tileSize);
			var i2 = Math.ceil(constrain(0, p2.x, nav.width)/tileSize);
			var j1 = Math.floor(constrain(0, p1.y, nav.height)/tileSize);
			var j2 = Math.ceil(constrain(0, p2.y, nav.height)/tileSize);
			var stride = Math.ceil(nav.width/tileSize);
			for (var j = j1; j < j2; j++)
			{
				for (var i = i1; i < i2; i++)
				{
					var xx = i*tileSize, yy = j*tileSize;
					var url = control.urlPrefix + "data/" + nav.id + "/" + (maxZ - integerZ + 1) + "-" + (i + j*stride) + ".jpg";
					adderFunc(url, xx, yy, Math.pow(2, integerZ));
					tiles[url].z = integerZ;
					tiles[url].imageID = nav.id;
				}
			}
		}

		var readjust = function()
		{
			z = constrain(0, z, boundZ);

			var t = Math.pow(2, z - 1);
			var minx = t*Stage.width;
			var maxx = nav.width - minx;
			var miny = t*Stage.height;
			var maxy = nav.height - miny;
			x = (minx > maxx) ? nav.width/2 : constrain(minx, x, maxx);
			y = (miny > maxy) ? nav.height/2 : constrain(miny, y, maxy);

			var c = Math.pow(2, -z);
			center.transform.matrix = new Matrix(1, 0, 0, 1, Stage.width/2, Stage.height/2);
			map.transform.matrix =
				new Matrix(c, 0, 0, c, -c*x, -c*y);

			var toRemove = [];
			for (var url in tiles)
			{
				var tile = tiles[url];
				if ((tile.z < Math.floor(z)) || (tile.imageID != nav.id))
				{
					tile.unload();
					toRemove.push(url);
				}
			}
			for (var i = 0; i < toRemove.length; i++)
				delete tiles[toRemove[i]];

			for (var i = 0; i < loadQueue.length; i++)
			{
				var url = loadQueue[i].url;
				tiles[url].unload();
				delete tiles[url];
			}
			loadQueue = [];

			addTiles(maxZ, addTile2);
			addTiles(z, addTile);
		}

		ExternalInterface.addCallback("readjust", null, readjust);
        
		var getTargetZ = function(targetW, targetH)
		{
			return Math.max(Math.log(nav.width/targetW), Math.log(nav.height/targetH))/Math.log(2);
		}

		var mouseIn = true;
		var highlightID = false;

		var setHighlightID = function(newID)
		{
			if (newID != highlightID)
			{
				if (highlightID && nav.links[highlightID])
					nav.links[highlightID].unhighlight();
				highlightID = newID;
				if (highlightID && nav.links[highlightID])
					nav.links[highlightID].highlight();
			}
		}

		var chooseHighlightID = function()
		{
			var bestID = false, maxJ = 0;
			if (mouseIn) for (var id in nav.links)
			{
				var clip = nav.links[id].clip;
				if (clip &&  clip._visible && clip.hitTest(_root._xmouse, _root._ymouse, true))
				{
					var xx = map._xmouse, yy = map._ymouse;
					var d = DistortedPicture.applyMultiple(nav.links[id].matrix, 
						[[xx, yy], [xx + 1, yy], [xx, yy + 1]]);
					var J = (d[1][0] - d[0][0])*(d[2][1] - d[0][1]) - (d[2][0] - d[0][0])*(d[1][1] - d[0][1]);
					if (J > maxJ)
					{
						bestID = id;
						maxJ = J;
					}
				}
			}

			setHighlightID(bestID);
		}

		control.highlightLink = setHighlightID;
		ExternalInterface.addCallback("highlightLink", null, control.highlightLink);
		control.unhighlightLink = function() { setHighlightID(false); };
		ExternalInterface.addCallback("unhighlightLink", null, control.unhighlightLink);

		var setMouseIn = function(flag)
		{
			mouseIn = flag;
			chooseHighlightID();
		}

		ExternalInterface.addCallback("setMouseIn", null, setMouseIn);

		linksArea.onMouseMove = function() { setMouseIn(true); }
		linksArea.onRelease = function()
		{
				if (wasMapDrag)
					return;
				if (!control.getNavEnabled())
					return;
				if (!highlightID)
					return;
				nav.links[highlightID].follow(false);
				highlightID = false;
		}

		var followingLink = false;

		control.followLink = function(id, dontPushHistory)
		{
			if (nav.links[id] && !followingLink)
				nav.links[id].follow(dontPushHistory);
			else
				control.loadNav(id, dontPushHistory);
		}
		ExternalInterface.addCallback("followLink", null, control.followLink);

		var addLink = function(id)
		{
			var link = nav.links[id];
			var clip = createClip(linksArea);
			link.clip = clip;
			clip._visible = false;

			var lp = [];
			for (var i = 0; i < 4; i++)
				lp.push([link.x[i], link.y[i]]);
			var directMatrix = DistortedPicture.buildMatrix(lp);
			lp = DistortedPicture.applyMultiple(directMatrix, [[0, 0], [1, 0], [1, 1], [0, 1]]);
			var nw = nav.width, nh = nav.height;
			for (var i = 0; i < 4; i++)
				if (!lp[i][2])
					lp[i] = [nw - 4*(lp[i][0] - nw), nh - 4*(lp[i][1] - nh)];

			link.matrix = DistortedPicture.inverse(directMatrix);

			var area = 0;
			for (var i = 0; i < 4; i++)
			{
				var ipp = (i == 3) ? 0 : (i + 1);
				area += (lp[i][0]*lp[ipp][1] - lp[ipp][0]*lp[i][1]);
			}
			link.area = Math.abs(area);

			var targetAlpha = 0, currentAlpha = 0;
			var recolor = function(nextAlpha)			
			{
				targetAlpha = nextAlpha;
				clip.onEnterFrame = function()
				{
					var d = targetAlpha - currentAlpha;
					var speed = 5;
					if (Math.abs(d) < speed)
						currentAlpha = targetAlpha;
					else
						currentAlpha += speed*((d > 0) ? 1 : (d == 0) ? 0 : -1);
					clip.clear();
					clip.beginFill(0xffffff, 0);
					clip.lineStyle(2, 0x000000, currentAlpha, false, "none");
					clip.moveTo(lp[0][0], lp[0][1]);
					clip.lineTo(lp[1][0], lp[1][1]);
					clip.lineTo(lp[2][0], lp[2][1]);
					clip.lineTo(lp[3][0], lp[3][1]);
					clip.lineTo(lp[0][0], lp[0][1]);
					clip.endFill();
					if (currentAlpha == targetAlpha)
						clip.onEnterFrame = null;
				}
			};
			link.highlight = function() { recolor(80); }
			link.unhighlight = function() { recolor(0); }
			link.unhighlight();

			var url = control.urlPrefix + "data/" + id + "/1-0.jpg";
			var tw, th;
			var c2 = createClip(clip);
			var loader = new MovieClipLoader();
			loader.addListener({ onLoadInit: function(mmc)
			{
				tw = mmc._width/2;
				th = mmc._height/2;
				c2.removeMovieClip();
				clip._visible = true;
				chooseHighlightID();

				var ppp = DistortedPicture.applyMultiple(directMatrix, [[0, 0.5], [0.5, 0.5], [1, 0.5]]);
			}});				
			loader.loadClip(url, c2);

			var backTransition = new DistortedPicture(transitionArea, control.urlPrefix + "data/" + nav.id + "/1-0.jpg", 3);
			var transition = new DistortedPicture(transitionArea, url, 3);

			link.follow = function(dontPushHistory)
			{
				if (transitionCleanup)
				{
					transitionCleanup();
					transitionCleanup = false;
				}

				followingLink = true;
				linksArea._visible = false;
				tileArea._visible = false;
				transitionArea._visible = true;
				transitionArea._quality = "LOW";
				makeHigher(transitionArea, map);

				var inv = map.transform.matrix;
				var p1 = [];
				for (var i = 0; i < 4; i++)
				{
					var pt = inv.transformPoint(new Point(link.x[i], link.y[i]));
					p1.push([pt.x, pt.y]);
				}
				var mat1 = DistortedPicture.buildMatrix(p1);

				var coef = Math.max(2*tw/Stage.width, 2*th/Stage.height);
				tw /= coef;
				th /= coef;
				if (link.w)
				{
					var mw = parseInt(link.w)/2;
					var mh = parseInt(link.h)/2;
					if (mw < tw)
					{
						tw = mw;
						th = mh;
					}
				}
				var mat2 = DistortedPicture.buildMatrix([[-tw, -th], [tw, -th], [tw, th], [-tw, th]]);

				var ttw = nav.width/Math.pow(2, z + 1);
				var tth = nav.height/Math.pow(2, z + 1);
				var cx = -(x - nav.width/2)/Math.pow(2, z);
				var cy = -(y - nav.height/2)/Math.pow(2, z);
				var p2 = DistortedPicture.applyMultiple(DistortedPicture.inverse(mat1), [
					[cx - ttw, cy - tth],
					[cx + ttw, cy - tth],
					[cx + ttw, cy + tth],
					[cx - ttw, cy + tth]
				]);

				var t = 0;
				map.onEnterFrame = function()
				{
					var tt = (1 - Math.cos(t*Math.PI))/2;

					transition.canvas._alpha = tt*100;
					backTransition.canvas._alpha = (1 - tt)*100;

					var mat = [];
					for (var i = 0; i < 3; i++)
					{
						mat[i] = [];
						for (var j = 0; j < 3; j++)
							mat[i][j] = (1 - tt)*mat1[i][j] + tt*mat2[i][j];
					}
					var backMat = DistortedPicture.buildMatrix(DistortedPicture.applyMultiple(mat, p2))
					transition.show(mat);
					backTransition.show(backMat);
					t += 0.05;
					if (t > 1.02)
					{
						map.onEnterFrame = null;
						transitionArea._quality = "HIGH";
						transitionCleanup = function() { transition.clear(); backTransition.clear(); };
						control.loadNav(id, dontPushHistory);
						followingLink = false;
					}
				}
			}

		}

		control.setNavigationInfo = function(arg)
		{
			if (nav)
			{
				for (var id in nav.links)
					nav.links[id].clip.removeMovieClip();
			}
			makeHigher(map, transitionArea);
			linksArea._visible = true;
			tileArea._visible = true;

			arg.width = parseInt(arg.width);
			arg.height = parseInt(arg.height);
			for (var id in arg.links)
			{
				for (var i = 0; i < 4; i++)
				{
					arg.links[id].x[i] = parseInt(arg.links[id].x[i]);
					arg.links[id].y[i] = parseInt(arg.links[id].y[i]);
				}
			}

			nav = arg;
			x = arg.width/2;
			y = arg.height/2;
			z = getTargetZ(Stage.width, Stage.height);
			maxZ = Math.ceil(getTargetZ(256, 256));
			if (z > maxZ)
				z = maxZ;
			if (z < 0)
				z = 0;
			boundZ = maxZ;

			var toRemove = [];
			for (var url in tiles)
				toRemove.push(url);
			for (var i = 0; i < toRemove.length; i++)
			{
				tiles[toRemove[i]].unload();
				delete tiles[toRemove[i]];
			}

			for (var id in nav.links)
				addLink(id);

			readjust();
		}
		ExternalInterface.addCallback("setNavigationInfo", null, control.setNavigationInfo);
		setTimeout(function()
		{
			var id1 = control.getFirstID();
			if (id1 != "null")
				control.loadNav(id1);
		}, 300);



		var isMouseDown, startMouseX, startMouseY, startX, startY, canceled;
		tileArea.onMouseDown = function() 
		{
			if (canceled)
				return;
			startMouseX = _root._xmouse;
			startMouseY = _root._ymouse;
			startX = x;
			startY = y;
			isMouseDown = true;
			wasMapDrag = false;
		}

		var recenter = function(mouseX, mouseY)
		{
			var c = Math.pow(2, z);
			x = startX - (mouseX - startMouseX)*c;
			y = startY - (mouseY - startMouseY)*c;
			readjust();
		}

		tileArea.onMouseMove = function()
		{
			if (canceled)
				return;
			if (isMouseDown)
			{
				recenter(_root._xmouse, _root._ymouse);
				if (Math.abs(_root._xmouse - startMouseX) + Math.abs(_root._ymouse - startMouseY) > 5)
					wasMapDrag = true;
			}
		}

		tileArea.onMouseUp = function() 
		{ 
			isMouseDown = false;
			canceled = false;
		}

		var onMouseWheel = function(delta) 
		{
			if (map.onEnterFrame)
				return;
			var t = 0;
			var dt = 0.1;
			var startZ = z;

			var sx = x, sy = y, sz = z, mx = map._xmouse, my = map._ymouse;

			map.onEnterFrame = function()
			{
				t += dt;
				if (t > 1)
				{
					t = 1;
					map.onEnterFrame = false;
				}
				z = constrain(0, startZ + t*0.7*((delta > 0) ? -1 : 1), boundZ);
				var c = (z == sz) ? (1 - t) : Math.pow(2, z - sz);
				x = mx + c*(sx - mx);
				y = my + c*(sy - my);
				readjust();
			}

		};

		Mouse.addListener({ onMouseWheel: onMouseWheel });
		ExternalInterface.addCallback("zoomBy", null, onMouseWheel);









		var editArea = createClip(map);
		var editP, editId;
		var distortedPicture = false;
		var corners = [];

		var repaintEditedLink = function()
		{
			distortedPicture.show(DistortedPicture.buildMatrix(editP));
			for (var i = 0; i < 4; i++)
			{
				var corner = corners[i];
				corner._visible = true;
				var size = Math.pow(2, z)*8;
				var xx = editP[i][0], yy = editP[i][1];
				corner.clear();
				corner.beginFill(0xffffff, 100);
				corner.lineStyle(1, 0xff0000, 100);
				corner.moveTo(xx - size, yy);
				corner.curveTo(xx - size, yy - size, xx, yy - size);
				corner.curveTo(xx + size, yy - size, xx + size, yy);
				corner.curveTo(xx + size, yy + size, xx, yy + size);
				corner.curveTo(xx - size, yy + size, xx - size, yy);
				corner.endFill();
			}
		}

		var editTilesClip = createClip(editArea);
		var editCornersClip = createClip(editArea);

		var startDragMx, startDragMy, dragPressed;

		editTilesClip.onPress = function()
		{
			startDragMx = map._xmouse;
			startDragMy = map._ymouse;
			dragPressed = true;
		}

		editTilesClip.onMouseMove = function()
		{
			if (!dragPressed)
				return;
			for (var i = 0; i < 4; i++)
			{
				editP[i][0] += (map._xmouse - startDragMx);
				editP[i][1] += (map._ymouse - startDragMy);
			}
			startDragMx = map._xmouse;
			startDragMy = map._ymouse;
		}

		editTilesClip.onMouseUp = function()
		{
			dragPressed = false;
		}

		var addCorner = function(i)
		{
			var corner = createClip(editCornersClip);
			var startMx, startMy, startCornerX, startCornerY;
			var pressed = false;
			corner.onPress = function()
			{
				startMx = map._xmouse;
				startMy = map._ymouse;
				startCornerX = editP[i][0];
				startCornerY = editP[i][1];
				pressed = true;
				canceled = true;
			}
			corner.onMouseMove = function()
			{
				if (!pressed) 
					return;
				var s = Math.pow(2, z);
				editP[i][0] = startCornerX + (map._xmouse - startMx);
				editP[i][1] = startCornerY + (map._ymouse - startMy);
			}
			corner.onMouseUp = function()
			{
				pressed = false;
			}
			corners.push(corner);
		}

		for (var i = 0; i < 4; i++)
			addCorner(i);

		ExternalInterface.addCallback("editLink", null, function(id, w, h)
		{
			if (id == nav.id)
				return;
			editId = id;

			if (nav.links[id])
			{
				editP = [];
				for (var i = 0; i < 4; i++)
					editP.push([nav.links[id].x[i], nav.links[id].y[i]]);
			}
			else
			{
				var sw = Math.pow(2, z)*w;
				var sh = Math.pow(2, z)*h;
				editP = [
					[x - sw, y - sh],
					[x + sw, y - sh],
					[x + sw, y + sh],
					[x - sw, y + sh]
				];
			}
			distortedPicture = new DistortedPicture(editTilesClip, control.urlPrefix + "data/" + id + "/1-0.jpg", 4);
			for (var i in nav.links)
				nav.links[i].clip._visible = false;
			editArea.onEnterFrame = repaintEditedLink;

			return (nav.links[id] ? true : false);
		});


		var clearEditedLink = function()
		{
			distortedPicture.clear();
			distortedPicture = false;
			editArea.onEnterFrame = null;
			for (var i = 0; i < 4; i++)
				corners[i]._visible = false;
			for (var id in nav.links)
				nav.links[id].clip._visible = true;
		}

		ExternalInterface.addCallback("editLinkOK", null, function()
		{
			ExternalInterface.call("editLinkOnServer", nav.id, editId, editP, 
				DistortedPicture.applyMultiple(DistortedPicture.inverse(distortedPicture.mat), [
					[0, 0],
					[nav.width, 0],
					[nav.width, nav.height],
					[0, nav.height]
				]));
		});

		ExternalInterface.addCallback("editLinkCancel", null, clearEditedLink);

		ExternalInterface.addCallback("toggleEdit", null, function()
		{
			editTilesClip._visible = !editTilesClip._visible;
		});

		Key.addListener({ onKeyDown: function()
		{
			if (distortedPicture && (Key.getCode() == Key.SPACE))
				editTilesClip._visible = !editTilesClip._visible;
		}});
	}
}
