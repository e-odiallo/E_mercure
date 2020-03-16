<!DOCTYPE html>

<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../css/newSpot-style.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<style>
    textarea{
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        padding: 25px;
    }

    textarea:focus{
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
</style>


<body>
<div class="wrapper fadeInDown">

    <h1 style="margin: 70px; font-size: 65px;">Description</h1>
    <h2>Dites nous en plus sur votre spot</h2>

    <div style="max-width: 700px;" id="formContent">
        <!-- Tabs Titles -->

        <!-- Login Form -->
        <form id="form">

        <textarea id="description"  style="resize: none; border: none; border-radius: 20px;" rows="10" cols="60">
        At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
        </textarea>


            <input type="submit" class="fadeIn fourth" value="Terminer">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a href="https://activdoor.000webhostapp.com">Retour à la carte</a>
        </div>

    </div>
</div>

<script>

    document.getElementById("form").addEventListener("submit", function (event) {
        var description = document.getElementById("description").value;
        if(description.length === 0){
            alert("vous devez entrer une description");
        }else{
            $.post("https://activdoor.000webhostapp.com/php/route.php?action=addSpot",
                {
                    description: description,
                },
                function(data, status){
                    console.log(data);
                    var obj = JSON.parse(data);
                    if(obj.result ==="success"){
                        window.open("https://activdoor.000webhostapp.com/php/route.php?action=spotAdded","_self");
                    }else{
                        alert(" pas okeks");
                    }
                }
            );
        }
        event.preventDefault();
    });

    /*Dropdown Menu*/
    $('.dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('.dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('.dropdown .dropdown-menu li').click(function () {
        $(this).parents('.dropdown').find('span').text($(this).text());
        $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
    });
    /*End Dropdown Menu*/


    $('.dropdown-menu li').click(function () {
        var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>',
            msg = '<span class="msg">Hidden input value: ';
        $('.msg').html(msg + input + '</span>');
    });
</script>

</body>

</html>
