function fnProgressChange(btnIncrDecr)
{
	var selBar   = document.getElementById('selBar').value;
	var barValue = document.getElementById('barValue_'+selBar).value;
	var Limit	 = document.getElementById('Limit').value;
	
	var newValue = parseInt(barValue) + parseInt(btnIncrDecr);
	
	if (newValue < 0)
	{
	newValue = 0;
	CurrentPercentage = 0;
	}
	else
	{
	CurrentPercentage = Math.round((newValue / Limit) * 100);
	}
	
	if (CurrentPercentage > 100)
	{
	var percentage = CurrentPercentage;
    col1="#F00";
    col2="#F00";
	}
	else
	{
    var percentage = CurrentPercentage;
	col1="#afd8e5";
    col2="#FFF";
	}
	
	//alert(barValue+'  '+btnIncrDecr+'  '+newValue);
	document.getElementById('barValue_'+selBar).value 	   = newValue;
	document.getElementById('barTextId_'+selBar).innerHTML = newValue+'%';
	
	var t = document.getElementById('barId_'+selBar);
	t.style.background = "-webkit-gradient(linear, left top,right top, color-stop("+percentage+"%,"+col1+"), color-stop("+percentage+"%,"+col2+"))";
	t.style.background = "-moz-linear-gradient(left center,"+col1+" "+percentage+"%, "+col2+" "+percentage+"%)";
	t.style.background = "-o-linear-gradient(left,"+col1+" "+percentage+"%, "+col2+" "+percentage+"%)";
	t.style.background = "linear-gradient(to right,"+col1+" "+percentage+"%, "+col2+" "+percentage+"%)";
}