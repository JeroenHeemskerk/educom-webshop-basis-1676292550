<?PHP

// =================================================================
// Main App
// =================================================================

session_start();
include 'validations.php';
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
    <title>' . strtoupper($page) . '</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image/x-icon" href="C:\xampp\htdocs\educom-webshop-basis\favicon.ico">
  </head>';
}

// =================================================================
// Functions for Body
// =================================================================

function showBodySection($page)
{
    echo '    <body>' . PHP_EOL;
    echo '<div id="page-container">
    <div id="content-wrap">' . PHP_EOL;
    showHeader($page);
    showMenu();
    showContent($page);
    echo ' </div>' . PHP_EOL;
    showFooter();
    echo '</div>' . PHP_EOL;
    echo '    </body>' . PHP_EOL;
}

function showHeader($page)
{
    switch ($page) {
        case 'home':
        case 'about':
        case 'contact':
        case 'register':
        case 'login':
            echo '<header>
        <h1>' . strtoupper($page) . '</h1>
      </header>';
            break;
        default:
            echo '<h1>Page not found</h1>';
            break;
    }
}

function showMenu()
{
    echo '<nav>
    <ul class="menu">
    <a href="index.php?page=home">
    <li>HOME</li>
    </a>
    <a href="index.php?page=about">
    <li>ABOUT</li>
    </a>    
    <a href="index.php?page=contact">
    <li>CONTACT</li> 
    </a>   
    <a href="index.php?page=register">
    <li>REGISTER</li> 
    </a>  
    <a href="index.php?page=login">
    <li>LOGIN</li> 
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
            $data = validateContact();
            showContactContent($data);
            break;
        case 'register':
            require('register.php');
            $data = validateRegistration();
            showRegisterContent($data);
            if ($data['valid'] === true) {
                $page = 'login';
            }
            break;
            break;
        case 'login':
            require('login.php');
            $data = validateLogin();
            showLoginContent($data);
            if ($data['valid'] === true) {
                logUserIn($data);
                $page = 'home';
            }
            break;
        case 'logout':
            logUserOut();
            $page = 'home';
            break;
        default:
            echo '<h1>This page does not exist</h1>';
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

// =================================================================

function endDocument()
{
    echo  '</html>';
}

// =================================================================
// Session
// =================================================================

function logUserIn($data)
{
    $_SESSION['username'] = $data['name'];
}

function logUserOut()
{
    session_unset();
}
