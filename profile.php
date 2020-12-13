

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="profile.css">
        <title>profile page</title>
    </head>
    <body>
    <div id="profilehead" >
        <div id = "pic" > </div>
        <div id = "name"> uname </div>
    </div>

    <div id = "info">
        <form action="profile.php" method = "GET">
        <input type="text" id ="uname" class = "field" value="uname">
        <input type="text" id ="fname" class="field" value="fname" >
        <input type = "text" id = "lname"class="field" value="lname">
        <input type="email" name="" id="email"class="field"value ="email@mail.com">
        <input type="number" size="10" id = "pnum" class="field"value = "0000000000">
        <input type="number" size="5" id="zip" class="field"value = "00000">
        <button type="submit" onclick='save();this.onclick = null;this.setAttribute("style", "color: #666");' />submit</button>
        </form>
    </div>
    </body>
</html>

