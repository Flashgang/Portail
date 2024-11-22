<?php
include "v_header.php";
?>
<div id="main">
    <div class="header">
        <h1>Compilateur</h1>
    </div>
    <div class="content">
        <center>
        <label for="lang-select">Choisissez un langage :</label>
        <select id="lang-select" onchange="changeLanguage()"></center>
            <option value="php">PHP</option>
            <option value="java">Java</option>
            <option value="csharp">C#</option>
            <option value="python3">Python</option>
            <option value="bash">Bash</option>
        </select>

        <a href="https://github.com/snaydo" target="_blank">
            <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" style="position:fixed;bottom:20px;right:20px;width:50px;height:50px;">
        </a>



        <div data-pym-src='https://www.jdoodle.com/plugin' data-language="<?php if(isset($_GET["lang"])) echo $_GET["lang"]; else echo "php";?>" data-version-index="4" data-libs="org.apache.commons:commons-lang3:3.4" id="code-block"><pre><?php
if (isset($_GET["lang"])) {
    switch($_GET["lang"]) {
        case "java":
            echo "public class Main {\n  public static void main(String[] args) {\n    System.out.println(\"Hello, world!\");\n  }\n}";
            break;
        case "csharp":
            echo "using System;\n\npublic class Program\n{\n    public static void Main()\n    {\n        Console.WriteLine(\"Hello, world!\");\n    }\n}";
            break;
        case "python3":
            echo "print(\"Hello, world!\")";
            break;
        case "bash":
            echo "echo \"Hello, world!\"";
            break;
        case "php":
            echo "&lt;?php \n    echo 'Hello, world!';\n?&gt;";
            break;   
    }
}
else {
    echo "&lt;?php \n    echo 'Hello, world!';\n?&gt;";
}
?></pre></div>


        </div>

        <script src="https://www.jdoodle.com/assets/jdoodle-pym.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            function changeLanguage() {
                var langSelect = document.getElementById("lang-select");
                var langValue = langSelect.options[langSelect.selectedIndex].value;

                var url = window.location.href.split('?')[0] + "?page=compiler&lang=" + langValue; // A MODIF POUR AVOIR LE BON URL

                window.location.href = url;
            }

            var searchParams = new URLSearchParams(window.location.search);
            var langParam = searchParams.get('lang');

            var codeBlock = document.getElementById("code-block");
            switch (langParam) {
                case "java":
                    codeBlock.setAttribute("data-language", "java");
                    break;
                case "csharp":
                    codeBlock.setAttribute("data-language", "csharp");
                    break;
                case "python3":
                    codeBlock.setAttribute("data-language", "python3");
                    break;
                case "bash":
                    codeBlock.setAttribute("data-language", "bash");
                    break;
                case "mysql":
                    codeBlock.setAttribute("data-language", "mysql");
                    break;
                default:
                    codeBlock.setAttribute("data-language", "php");
            }

            document.getElementById("lang-select").value = langParam ? langParam : "php";
        </script>
    </div>
</div>
<?php include "v_bottom.php"; ?>
