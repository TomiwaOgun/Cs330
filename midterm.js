function calculateResult(event)
{
    var isValid = true; 
    var elements = event.currentTarget;

    var number1 = elements[0].value;
    var number2 = elements[1].value;
    var regex_numb = /^[0-9]+$/;

    var n1err = document.getElementById("n1Err");
    var n2err = document.getElementById("n2Err");
    var result = document.getElementById("result-text");
    result.innerHTML="";

    if (regex_numb.test(number1) == false) 
    {
        isValid = false;
        n1err.setAttribute("style", "display: inline")
    }

    if (regex_numb.test(number2) == false) 
    {
        isValid = false;
        n2err.setAttribute("style", "display: inline")
    }

    if (isValid = false)
    {
        event.preventDefault();
    }
    else
    {
        var a = parseInt(number1);
        var b = parseInt(number2);
        var c = a+b;
        result.innerHTML=c;
    }

}

document.getElementById("calculator").addEventListener("submit",calculateResult,false);