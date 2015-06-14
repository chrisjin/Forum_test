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
    var attr = theInput.attr('data-minlength');
    if (typeof (attr) != "undefined" && attr !== null) {
        if (theInput.val().length >= attr) {
            return true;
        }
        else
            return false;
    }
    else
        return true;
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
function CheckInput(theInput)
{
    var aRet = true;
    aRet &= CheckInputByLength(theInput);
    aRet &= CheckInputByRegex(theInput);
    aRet &= CheckInputByType(theInput);
    return aRet;
}


function MakeInputValid(theInput, theBool) {
    if (theBool) {
        if (theInput.next("span.help-block").exists())
            theInput.next("span.help-block").hide();
        theInput.parent('.form-group').removeClass('has-error');
    }
    else {
        theInput.parent('.form-group').addClass('has-error');
        if (theInput.next("span.help-block").exists())
            theInput.next("span.help-block").show();
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

