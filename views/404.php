<?php include_once 'layouts/main/header.php' ?>
<div id="404">
    <div class="tile is-vertical is_parent">
        <pre class="tile is-child content is-hidden-mobile" style="background: unset;">
            #include &lt;iostream&gt;;<br>
            <br>
            int main(int argc, char **argv) {<br>
                std::cout &lt;&lt; &quot;Error 404, you seems to have gotten to the wrong place&quot;;<br>
                return 0;<br>
            }<br>
        </pre>
        <pre class="tile is-child content is-hidden-mobile">
        
            Last login: Sun Sep 10 21:03:08 on ttys001
            machine:~$ g++ -o main main.cpp
            machine:~$ ./main
            > Error 404, you seems to have gotten to the wrong place
            machine:~$ 
        </pre>
        <div class="tile is-child content is-hidden-tablet">
            <h1 style="text-align: center">404</h1>
            <img src="../../assets/images/schild.png" alt="">
        </div>
    </div>
</div>
<?php include_once 'layouts/main/footer.php' ?>