import flash.geom.*;
import flash.external.*;
import flash.display.*;

class DistortedPicture
{
	var parent, url, clips = [], loaded = false, width, height, bitmap, n, mat = false;
	public var canvas;

	function DistortedPicture(parent, url, n)
	{
		this.parent = parent;
		this.url = url;
		this.n = n;

		this.canvas = createClip();
		var pic = this;

		var loader = new MovieClipLoader();
		loader.addListener({
			onLoadInit: function(tg)
			{
				pic.loaded = true;
				pic.width = tg._width;
				pic.height = tg._height;
				pic.bitmap = new BitmapData(pic.width, pic.height);
				pic.bitmap.draw(tg);
				tg.removeMovieClip();
				if (pic.mat)
					pic.show(pic.mat);
			}
		});
		loader.loadClip(url, createClip());
	}

	function createClip()
	{
		var clip = parent.createEmptyMovieClip(
			"clip_" + Math.round(100000*Math.random()), 
			parent.getNextHighestDepth()
		);
		clips.push(clip);
		return clip;
	}

	function clear()
	{
		canvas.removeMovieClip();
	}

	function show(mat)
	{
		this.mat = mat;
		if (!loaded)
			return;

		canvas.clear();
		for (var i = 0; i < n; i++)
		{
			for (var j = 0; j < n; j++)
			{
				var p1 = apply(mat, [i/n, j/n]);
				var p2 = apply(mat, [(i + 1)/n, j/n]);
				var p3 = apply(mat, [i/n, (j + 1)/n]);
				if (p1[2] && p2[2] && p3[2])
				{
					var m = new Matrix(1, 0, 0, 1, -i*width/n, -j*height/n);
					m.concat(new Matrix(
						(p2[0] - p1[0])*n/width,
						(p2[1] - p1[1])*n/width,
						(p3[0] - p1[0])*n/height,
						(p3[1] - p1[1])*n/height,
						p1[0],
						p1[1]
					));
					canvas.beginBitmapFill(bitmap, m);
					canvas.moveTo(p1[0], p1[1]);
					canvas.lineTo(p2[0], p2[1]);
					canvas.lineTo(p3[0], p3[1]);
					canvas.endFill();
				}

				p1 = apply(mat, [(i + 1)/n, (j + 1)/n]);
				p2 = apply(mat, [(i + 1)/n, j/n]);
				p3 = apply(mat, [i/n, (j + 1)/n]);
				if (p1[2] && p2[2] && p3[2])
				{
					var m = new Matrix(1, 0, 0, 1, -(i + 1)*width/n, -(j + 1)*height/n);
					m.concat(new Matrix(
						-(p3[0] - p1[0])*n/width,
						-(p3[1] - p1[1])*n/width,
						-(p2[0] - p1[0])*n/height,
						-(p2[1] - p1[1])*n/height,
						p1[0],
						p1[1]
					));
					canvas.beginBitmapFill(bitmap, m);
					canvas.moveTo(p1[0], p1[1]);
					canvas.lineTo(p2[0], p2[1]);
					canvas.lineTo(p3[0], p3[1]);
					canvas.endFill();
				}
			}
		}
	}

	static function buildMatrix(p)
	{
		var x0 = p[0][0], y0 = p[0][1];
		var t = [
			[p[1][0] - x0, p[3][0] - x0, x0], 
			[p[1][1] - y0, p[3][1] - y0, y0], 
			[0, 0, 1]
		];
		var it = inverse(t);
		var pp = apply(it, [p[2][0], p[2][1]]);
		var z = pp[0] + pp[1] - 1;
		var a = pp[0]/z;
		var b = pp[1]/z;
		var ret = multiply(t, [[a, 0, 0], [0, b, 0], [a - 1, b - 1, 1]]);
		if (det(ret) < 0)
			for (var i = 0; i < 3; i++)
				for (var j = 0; j < 3; j++)
					ret[i][j] = -ret[i][j];
		return ret;
	}

	static function det(m)
	{
		var ret = 0;
		for (var i = 0; i < 3; i++)
		{
			var i1 = (i + 1)%3, i2 = (i + 2)%3;
			ret += m[0][i]*(m[1][i1]*m[2][i2] - m[1][i2]*m[2][i1]);
		}
		return ret;
	}

	static function scaleMatrix(m, s)
	{
		var ret = [];
		for (var i = 0; i < 3; i++)
		{
			ret[i] = [];
			for (var j = 0; j < 3; j++)
				ret[i][j] = m[i][j]*s;
		}
		return ret;
	}

	static function line(p1, p2)
	{
		return [
			p2[1] - p1[1],
			p1[0] - p2[0],
			p1[1]*p2[0] - p1[0]*p2[1]
		];
	}

	static function intersect(l1, l2)
	{
		var z = l1[0]*l2[1] - l1[1]*l2[0];
		return [
			(l1[1]*l2[2] - l1[2]*l2[1])/z,
			(l2[0]*l1[2] - l2[2]*l1[0])/z
		];
	}

	static function lincom(l1, l2, p)
	{
		var t = -applyLine(l1, p)/applyLine(l2, p);
		return [l1[0] + t*l2[0], l1[1] + t*l2[1], l1[2] + t*l2[2]];
	}

	static function multiply(m1, m2)
	{
		var m = [];
		for (var i = 0; i < 3; i++)
		{
			m[i] = [];
			for (var j = 0; j < 3; j++)
			{
				m[i][j] = 0;
				for (var k = 0; k < 3; k++)
					m[i][j] += m1[i][k]*m2[k][j];
			}
		}
		return m;
	}

	static function inverse(m)
	{
		var m2 = [];
		for (var i = 0; i < 3; i++)
		{
			m2[i] = [];
			for (var j = 0; j < 3; j++)
			{
				var i1 = (i+1)%3;
				var j1 = (j+1)%3;
				var i2 = (i+2)%3;
				var j2 = (j+2)%3;
				m2[i][j] = m[j1][i1]*m[j2][i2] - m[j2][i1]*m[j1][i2];
			}
		}
		var det = 1/(m[0][0]*m2[0][0] + m[1][0]*m2[0][1] + m[2][0]*m2[0][2]);
		for (var i = 0; i < 3; i++)
			for (var j = 0; j < 3; j++)
				m2[i][j] *= det;
		return m2;
	}

	static function applyLine(l, p)
	{
		return l[0]*p[0] + l[1]*p[1] + l[2];
	}

	static function apply(m, p)
	{
		var z = applyLine(m[2], p);
		return [applyLine(m[0], p)/z, applyLine(m[1], p)/z, z > 0];
	}

	static function applyMultiple(m, ps)
	{
		var ret = [];
		for (var i = 0; i < ps.length; i++)
			ret.push(apply(m, ps[i]));
		return ret;
	}
}
