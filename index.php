<?php
$json_entry = file_get_contents("people.json");
$name_list = json_decode($json_entry, TRUE);
$msg_list = file("messages.txt");

if(!empty($_POST["person"]))
{
    error_reporting(0);

    $en_name = $_POST["person"];
    $fa_name = $name_list[$en_name];

    $question = $_POST["question"];
    $q_last = strlen($question) - 1;
    
    $msg_tag =((int) sha1($question.$fa_name));
    $msg = $msg_list[$msg_tag % count($msg_list)];
}
else
{
    $en_name = "abooreyhan";
    $fa_name = $name_list[$en_name];
    $question = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <span id="label">
            <?php
            if( (!empty($question)) and str_starts_with($question, "آیا") and (str_ends_with($question, "?") or str_ends_with($question, "؟")) )
            {
                echo "پرسش:";
            }
            ?>
        </span>
        <span id="question">
            <?php
            if( (!empty($question)) and str_starts_with($question, "آیا") and (str_ends_with($question, "?") or str_ends_with($question, "؟")) )
            {
                echo $question;
            }
            ?>
        </span>
    </div>
    <div id="container">
        <div id="message">
            <p style= "font-size: 430%">
                <?php
                if(!empty($question))
                {
                    if( str_starts_with($question, "آیا") and (str_ends_with($question, "?") or str_ends_with($question, "؟")) )
                    {
                        echo $msg;
                    }
                    else
                    {
                        echo "سوال درستی پرسیده نشده";
                    }
                }
                else echo "سوال خود را بپرس!";
                ?>
            </p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php
                foreach($name_list as $english => $farsi)
                {
                    echo "<option value = $english>$farsi</option>";
                }
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>