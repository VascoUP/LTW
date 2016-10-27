<html>
    <head>
        <title>Calculadora</title>
    </head>
    <body>
        <h1>MELHOR CALCULADORA DO MUNDO:</h1>
        <?php 
            $num1 = $_GET['num1'];
            $operator = $_GET['operator'];
            $num2 = $_GET['num2'];
            $res = $num1 + $num2;
            if( $operator == '+' )
                $res = $num1 + $num2;
            else if( $operator == '-' )
                $res = $num1 - $num2;
            else if( $operator == '*' )
                $res = $num1 * $num2;
            else if( $operator == '/' )
                $res = $num1 / $num2;
            echo "<p>$num1 $operator $num2 = $res</p>";
        ?>
    <p><a href="form2.html"> Calculadora</a></p>
    </body>
</html>