// Created by iWeb 2.0 local-build-20070821

function createMediaStream_id2()
{return IWCreatePhotocast("http://tdc.mit.edu/TDC/House/Pages/First_Floor_Basement_files/rss.xml",true,true);}
function initializeMediaStream_id2()
{createMediaStream_id2().load('http://tdc.mit.edu/TDC/House/Pages',function(imageStream)
{var entryCount=imageStream.length;var headerView=widgets['widget1'];headerView.setPreferenceForKey(imageStream.length,'entryCount');NotificationCenter.postNotification(new IWNotification('SetPage','id2',{pageIndex:0}));});}
function layoutMediaGrid_id2(range)
{createMediaStream_id2().load('http://tdc.mit.edu/TDC/House/Pages',function(imageStream)
{if(range==null)
{range=new IWRange(0,imageStream.length);}
IWLayoutPhotoGrid('id2',new IWPhotoGridLayout(3,new IWSize(195,195),new IWSize(195,14),new IWSize(216,224),27,27,0,new IWSize(0,0)),new IWStrokeParts([{rect:new IWRect(-5,5,10,185),url:'First_Floor_Basement_files/stroke.png'},{rect:new IWRect(-5,-5,10,10),url:'First_Floor_Basement_files/stroke_1.png'},{rect:new IWRect(5,-5,185,10),url:'First_Floor_Basement_files/stroke_2.png'},{rect:new IWRect(190,-5,10,10),url:'First_Floor_Basement_files/stroke_3.png'},{rect:new IWRect(190,5,10,185),url:'First_Floor_Basement_files/stroke_4.png'},{rect:new IWRect(190,190,10,10),url:'First_Floor_Basement_files/stroke_5.png'},{rect:new IWRect(5,190,185,10),url:'First_Floor_Basement_files/stroke_6.png'},{rect:new IWRect(-5,190,10,10),url:'First_Floor_Basement_files/stroke_7.png'}],new IWSize(195,195)),imageStream,range,null,null,1.000000,{backgroundColor:'#000000',reflectionHeight:100,reflectionOffset:2,captionHeight:100,fullScreen:0,transitionIndex:2},'../../Media/slideshow.html','widget1','widget2','widget3')});}
function relayoutMediaGrid_id2(notification)
{var userInfo=notification.userInfo();var range=userInfo['range'];layoutMediaGrid_id2(range);}
function onStubPage()
{var args=getArgs();parent.IWMediaStreamPhotoPageSetMediaStream(createMediaStream_id2(),args.id);}
if(window.stubPage)
{onStubPage();}
setTransparentGifURL('../../Media/transparent.gif');function hostedOnDM()
{return false;}
function onPageLoad()
{IWRegisterNamedImage('comment overlay','../../Media/Photo-Overlay-Comment.png')
IWRegisterNamedImage('movie overlay','../../Media/Photo-Overlay-Movie.png')
IWRegisterNamedImage('contribution overlay','../../Media/Photo-Overlay-Contribution.png')
loadMozillaCSS('First_Floor_Basement_files/First_Floor_BasementMoz.css')
adjustLineHeightIfTooBig('id1');adjustFontSizeIfTooBig('id1');NotificationCenter.addObserver(null,relayoutMediaGrid_id2,'RangeChanged','id2')
adjustLineHeightIfTooBig('id3');adjustFontSizeIfTooBig('id3');Widget.onload();initializeMediaStream_id2()
performPostEffectsFixups()}
function onPageUnload()
{Widget.onunload();}
