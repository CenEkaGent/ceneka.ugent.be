<!DOCTYPE html>
<html lang="nl"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CenEka | <?php if(isset($descriptor)) { echo $descriptor; } else { echo 'Computerwetenschappen en elektrotechniek van de Universiteit Gent'; }; ?></title>
    <link rel="stylesheet" href="../../../assets/stylesheets/bulma.css">
    <link rel="stylesheet" href="../../../assets/stylesheets/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/stylesheets/main.css">
    <link rel="stylesheet" href="../../../assets/stylesheets/bulma-override.css">
    <link rel='shortcut icon' type='image/x-icon' href='../../../assets/images/favicon.ico' />
    <meta name="Title" content="CenEka: Computerwetenschappen en elektrotechniek van de Universiteit Gent">
    <meta name="Keywords" content="ceneka, elektrotechniek, burgerlijk ingenieur, gent, computerwetenschappen, universiteit gent, ghent university, electrical, engnineering, computer science">
    <meta name="Description" content="Studentenvereniging van de burgerlijk ingenieurs Computerwetenschappen en Elektrotechniek aan de Universiteit Gent.">
</head>
<body class="site">
    <div class="wrapper">
        <div class="container">
            <header class="section">
                <div id="navbar">
                    <div class="columns">
                        <div id="huisstijl" class="column is-hidden-mobile">
                            <div id="circle-grey"></div>
                            <div id="top-branch">
                                <div class="name"><a href="/"><span class="special-letter">C</span><span class="normal-letter">en</span><span class="special-letter">E</span><span class="normal-letter">ka</span></a></div>
                                <div id="top-tilted"></div>
                                <div id="top-straight"></div>
                                <div id="circle-red"></div>
                            </div>
                            <div id="bottom-branch">
                                <div id="bottom-tilted"></div>
                                <div id="bottom-straight"></div>
                                <div id="square"></div>
                            </div>
                            <div id="straight"></div>
                            <div id="arrowtip"></div>
                        </div>
                        <div class="column actual-nav-bar">
                            <nav class="nav">
                                <span class="nav-toggle" onClick="toggle_nav()">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <div class="nav-menu nav-left">
                                    <a class="nav-item is-tab " href="/about/">About</a>
                                    <a class="nav-item is-tab " href="/events/17-18/">Events</a>
                                    <a class="nav-item is-tab " href="/applications/">Aanbiedingen</a>
                                    <a class="nav-item is-tab " href="/companies/">Bedrijven</a>
                                </div>
                                <div class="name is-hidden-tablet"><a href="/"><span class="special-letter">C</span><span class="normal-letter">en</span><span class="special-letter">E</span><span class="normal-letter">ka</span></a></div>
                                <!-- Filler for when mobile -->
                                <div class="nav-left is-hidden-tablet"></div>
                                <a class="is-hidden-tablet nav-item" href="/">
                                    <img id="inline-logo" src="../../../assets/images/favicon-128.png" alt="logo">
                                </a>
                            </nav>
                        </div>
                        <div class="column is-hidden-mobile" id="nav-icons">
                            <a class="social-icon" href="https://github.com/CenEkaGent" target="_blank">
                                <span class="icon">
                                <i class="fa fa-github"></i>
                                </span>
                            </a>
                            <a class="social-icon" href="https://www.facebook.com/CenEkaGent/" target="_blank">
                                <span class="icon">
                                <i class="fa fa-facebook"></i>
                                </span>
                            </a>
                            <a class="social-icon" href="https://vtk.ugent.be/wiki" target="_blank">
                                <span class="icon">
                                <i class="fa fa-wikipedia-w"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <main class="section" id="main-section">