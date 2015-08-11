$.fn.exists = function () {
    return this.length !== 0;
}

function HandleHelpBlock(form) {
    $(form).find('.help-block').each(function (index) {
        $(this).hide();
    });
}
function HandleTextInput(form) {
    $(form).find("input[type='text'], textarea").each(function (index) {
        $(this).focusout(function () {
            UpdateInput($(this));
        });
        $(this).on('input', function () {
            UpdateInputTurningGood($(this));
        });
    });
}

function CheckInputByLength(theInput) {
    var attrmin = theInput.attr('data-minlength');
    var attrmax = theInput.attr('data-maxlength');
    if (typeof (attrmin) == "undefined" || attrmin == null) {
        attrmin = -Number.MAX_VALUE;
    }
    if (typeof (attrmax) == "undefined" || attrmax == null) {
        attrmax = Number.MAX_VALUE;
    }
    if (theInput.val().length >= attrmin && theInput.val().length<= attrmax) {
        return true;
    }
    else
        return false;
}


function IsEmail(theStr) {
    var reg = new RegExp("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$");
    return reg.test(theStr);
}

function CheckInputByType(theInput) {
    var attr = theInput.attr('data-type');
    if (typeof (attr) != "undefined" && attr !== null) {
        if(attr == 'email')
        {
            return IsEmail(theInput.val());
        }
        return false;
    }
    else
        return true;
}
function CheckInputByRegex(theInput) {
    var attr = theInput.attr('data-regex');
    if (typeof (attr) != "undefined" && attr !== null) {
        var reg = new RegExp(attr);
        if (reg.test(theInput.val())) {
            return true;
        }
        else
            return false;
    }
    else
        return true;
}

function GetErrorBlockID(theInput) {
}

function CheckInput(theInput){
    var aRet = true;
    aRet &= CheckInputByLength(theInput);
    aRet &= CheckInputByRegex(theInput);
    aRet &= CheckInputByType(theInput);
    return aRet;
}


function MakeInputValid(theInput, theBool, warnblockid) {
    if (typeof warnblockid === 'undefined')
        warnblockid = "";
    else
        warnblockid = "#" + warnblockid;
    var selector = ".help-block" + warnblockid;
    if (theBool) {
        if (theInput.next(selector).exists())
            theInput.next(selector).hide();
        theInput.parent('.form-group').removeClass('has-error');
    }
    else {
        theInput.parent('.form-group').addClass('has-error');
        if (theInput.next(selector).exists())
            theInput.next(selector).show();
    }
}
function UpdateInput(theInput) {
    MakeInputValid(theInput, CheckInput(theInput));
}
function UpdateInputTurningGood(theInput)
{
    if(CheckInput(theInput))
        MakeInputValid(theInput, CheckInput(theInput));
}

function CheckAllInput(theForm)
{
    var theRet = true;
    theForm.find("input[type='text']").each(function (index) {
        UpdateInput($(this));
        if (!CheckInput($(this)))
        {
            theRet = false;
        }
    });
    return theRet;
}

$("form[data-toggle='formvalidator']").each(function (index) {
    HandleHelpBlock(this);
    HandleTextInput(this);
});

$("form[data-toggle='formvalidator']").submit(function (e) {
    e.preventDefault();
    if (CheckAllInput($(this))) {
        this.submit();
        alert('Submit Successful!');
    }
    else
        alert('Please fill all fields!');
});



//function People() {  
//    testvar = "E";
//}

//People.prototype.KKK = function () {
//    this.testvar = "U";
//};
//var p1 = new People();
//alert(testvar);
//alert(typeof People.prototype);
////??
//var p1 = new People("Windking");
//p1.Introduce();
//People.Run();
//p1.IntroduceChinese();