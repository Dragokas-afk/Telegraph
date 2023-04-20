<pre>
    <?php
    include_once 'autoload.php';

    $textStorage = [

        ['title', 'text']
    ];


    function add($title, $text, &$arr)
    {
        $test = ['title' => $title, 'text' => $text];
        array_push($arr, $test);

    }

    function remove($index, $arr)
    {
        if(!empty($arr[$index])) {
            return true;
        } else {
            return false;
    }
    }


    function edit($index, $title, $text, &$arr) {
        if(!empty($arr[$index])) {
            $arr[$index] = ['title' => $title, 'text' => $text];
            return true;
        } else {
            return false;
        }

    }

$obj = new TelegraphText('Lesya', 'text');
$obj1 = new FileStorage();

var_dump($obj1);

$obj1->create($obj);
    $obj->loadText;



    ?>

</pre>

