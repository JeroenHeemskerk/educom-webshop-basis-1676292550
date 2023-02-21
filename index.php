<?PHP

// =================================================================
// Main App
// =================================================================

$page = getRequestedPage();
showResponsePage($page);

// =================================================================
// Functions
// =================================================================

function getRequestedPage()
{
    $request_type = $_SERVER['REQUEST_METHOD'];

    if ($request_type == 'POST') {
        $requested_page = getPostVar('page', 'home');
    } else if ($request_type == 'GET') {
        $requested_page = getUrlVar('page', 'home');
    }
    return $requested_page;
}

function showResponsePage($page)
{
    beginDocument();
    showHeadSection($page);
    showBodySection($page);
    endDocument();
}

function getPostVar($key, $default = '')
{
    $value = filter_input(INPUT_POST, $key);
    return isset($value) ? $value : $default;
}

function getUrlVar($key, $default = '')
{
    $value = filter_input(INPUT_GET, $key);
    return isset($value) ? $value : $default;
}

function beginDocument()
{
    echo '<!doctype html> 
<html>';
}

function showHeadSection($page)
{

    echo '<head>
    <title>' . $page . '</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="C:\xampp\htdocs\educom-webshop-basis\favicon.ico">
  </head>';
}

function showBodySection($page)
{
    echo '    <body>' . PHP_EOL;
    showHeader($page);
    showMenu();
    showContent($page);
    showFooter();
    echo '    </body>' . PHP_EOL;
}

function endDocument()
{
    echo  '</html>';
}

function showHeader($page)
{
    echo '<header>
    <h1>' . $page . '</h1>
  </header>';
}

function showMenu()
{
    echo '<nav>
    <ul class="menu">
    <a href="index.php?page=home>
            <li>HOME</li>
        </a>
        <a href="index.php?page=about>
            <li>ABOUT</li>
        </a>
        <a href="index.php?page=contact>
            <li>CONTACT</li>
        </a>
    </ul>
</nav>';
}

function showContent($page)
{
    switch ($page) {
        case 'home':
            require('home.php');
            showHomeContent();
            break;
        case 'about':
            require('about.php');
            showAboutContent();
            break;
        case 'contact':
            require('contact.php');
            showContactContent();
    }
}

function showFooter()
{
    echo '
    <footer>
    <p>&copy; <script>
        document.write(new Date().getFullYear())
      </script> Lydia van Gammeren All Rights Reserved</p>
  </footer>';
}
