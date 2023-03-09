function getFlashMovieObject(movieName)
{
  if (window.document[movieName]) 
  {
    return window.document[movieName];
  }
  if (navigator.appName.indexOf("Microsoft Internet")==-1)
  {
    if (document.embeds && document.embeds[movieName])
      return document.embeds[movieName]; 
  }
  else // if (navigator.appName.indexOf("Microsoft Internet")!=-1)
  {
    return document.getElementById(movieName);
  }
}

function StopFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.StopPlay();
}

function PlayFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.Play();
	//embed.nativeProperty.anotherNativeMethod();
}

function RewindFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.Rewind();
}

function NextFrameFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	// 4 is the index of the property for _currentFrame
	var currentFrame=flashMovie.TGetProperty("/", 4);
	var nextFrame=parseInt(currentFrame);
	var totalFrames = flashMovie.TotalFrames();
	if (nextFrame>=totalFrames)
		nextFrame=0;
	flashMovie.GotoFrame(nextFrame);		
}

function PrevFrameFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	// 4 is the index of the property for _currentFrame
	var currentFrame=flashMovie.TGetProperty("/", 4);
	var nextFrame=parseInt(currentFrame)-2;
	var totalFrames = flashMovie.TotalFrames();
	if (nextFrame==-1)
		nextFrame=totalFrames;
	flashMovie.GotoFrame(nextFrame);		
}

function currentFram()
{
	var flashMovie=getFlashMovieObject("movie");
	// 4 is the index of the property for _currentFrame
	var currentFrame=flashMovie.TGetProperty("/", 4);
	var curr=parseInt(currentFrame)-2;
	return curr;		
}

function gotoFrameF(frame)
{
	var flashMovie=getFlashMovieObject("movie");
	// 4 is the index of the property for _currentFrame
	flashMovie.GotoFrame(frame);		
}

function ZoominFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.Zoom(90);
}

function totalFramess()
{
	var flashMovie=getFlashMovieObject("movie");
	return flashMovie.TotalFrames();
}

function ZoomoutFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.Zoom(110);
}

function FullscreenFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.FSCommand(Fullscreen, true);
}

function SendDataToFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	flashMovie.SetVariable("/:message", document.controller.Data.value);
}

function ReceiveDataFromFlashMovie()
{
	var flashMovie=getFlashMovieObject("movie");
	var message=flashMovie.GetVariable("/:message");
	document.controller.Data.value=message;
}