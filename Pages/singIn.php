<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/singInStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="ring">
        <i></i>
        <i></i>
        <i></i>
        <div class="contact">
            <h2>Message</h2>
            <form action="#" method="post">
                <div class="InputBx">
                    <input type="text" name="name" placeholder="Name" required pattern="^[A-Za-z\s]+$" title="Name can only contain Latin letters and spaces.">
                </div>
                <div class="InputBx">
                    <input type="text" name="Surname" placeholder="Surname" required pattern="^[A-Za-z\s]+$" title="Surname can only contain Latin letters and spaces.">
                </div>
                <div class="InputBx">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="InputBx">
                    <input type="text" name="subject" placeholder="Message Subject" required>
                </div>
                <div class="InputBx">
                    <textarea placeholder="Your message..." required></textarea>
                </div>
                <div class="InputBx">
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
    </div>
</body>
</html>