<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle's ist theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_ist
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get the HTML for the settings bits.
$html = theme_ist_get_html_for_settings($OUTPUT, $PAGE);

// Set default (LTR) layout mark-up for a three column page.
$regionmainbox = 'span9';
$regionmain = 'span8 pull-right';
$sidepre = 'span4 desktop-first-column';
$sidepost = 'span3 pull-right';
// Reset layout mark-up for RTL languages.
if (right_to_left()) {
    $regionmainbox = 'span9 pull-right';
    $regionmain = 'span8';
    $sidepre = 'span4 pull-right';
    $sidepost = 'span3 desktop-first-column';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel="stylesheet" type="text/css">
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner" class="navbar navbar-fixed-top<?php echo $html->navbarclass ?> moodle-has-zindex">
    <nav role="navigation" class="navbar-inner">
      <!--  <div class="container-fluid">
           <div style="height: 28px; background-color: rgb(221, 155, 53);">
        <div style="margin-left: 5%; line-height: 28px; color: white; font-weight: bold; font-size: 15px;">KMIT</div>
    </div>    -->
    <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><p style="color: #FFF ! important; font-weight: bold; font-size: 28px; padding-bottom: 0px ! important; margin-bottom: 0px ! important;">TESSELLATOR</p></a>

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php echo $OUTPUT->user_menu(); ?>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">
    <?php echo $OUTPUT->full_header(); ?>
    <div id="page-content" class="row-fluid">
        <div id="region-main-box" class="<?php echo $regionmainbox; ?>">
            <div class="row-fluid">
                <section id="region-main" class="<?php echo $regionmain; ?>">
                    <?php
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php echo $OUTPUT->blocks('side-pre', $sidepre); ?>
            </div>
        </div>
        <?php echo $OUTPUT->blocks('side-post', $sidepost); ?>
    </div>

    <footer id="page-footer">
        <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
        <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
        <?php
        echo $html->footnote;
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>
<style>
input[type="button"], input[type="submit"] {
    color: #FFF;
    text-shadow: none;
    background-repeat: repeat;
    background-color: #e0a549 !important;
    background-image:none !important;
}
input[type="button"]:focus, input[type="submit"]:focus,input[type="button"]:hover, input[type="submit"]:hover {
    color: #FFF;
    text-shadow: none;
    background-repeat: repeat;
    background-color: #DD9B35 !important;
    background-image:none !important;
}
#gtt{
color:white;
}
.usermenu .moodle-actionmenu .toggle-display .userbutton .usertext {
    display: inline-block;
    line-height: 1em;
    color: inherit !important;
    vertical-align: middle;
    color: #3F2700 !important;
}
.navbar-inner .show {
    background-color: #FAF2E5 !important;
    background-image: none;
    background-repeat: repeat-x;
}
.jsenabled .usermenu .moodle-actionmenu.show .menu a:hover,.jsenabled .usermenu .moodle-actionmenu.show .menu  a:focus {
    background-color:#f4e1c2 !important;

}
.usermenu .moodle-actionmenu[data-enhanced] .menu .menu-action.icon img, .usermenu .moodle-actionmenu[data-enhanced] .menu .menu-action.icon:hover img {
	
	box-shadow: none;
	width: 21px;
	height: 21px;
}
.usermenu .menu a:hover,.usermenu .menu a:focus{
    background-color:#f4e1c2 !important;
}
.jsenabled .usermenu .moodle-actionmenu.show .menu a:focus, .jsenabled .usermenu .moodle-actionmenu.show .menu a:hover {
    background-color:#f4e1c2 !important;
}
.navbar-inner > .container-fluid {
	box-shadow: 0px 1px 4px rgba(213, 131, 3, 0.6);
	background-color: #c14800 !important;
	background-image: none !important;
}
#wsearch{
    height: 34px !important;
    padding: 0px 0px 0px 20px;
    width: 206px !important;
    background: rgb(255, 255, 255) url('<?php echo $CFG->wwwroot."/theme/ist/pix/search.png";?>') no-repeat scroll left center;
}

#search1, #wsearch, #search1{
    height: 34px !important;
    padding: 0px 0px 0px 20px;
    width: 206px !important;
    background: rgb(255, 255, 255) url('<?php echo $CFG->wwwroot."/theme/ist/pix/search.png";?>') no-repeat scroll left center;
}
.span2 .btn-primary {

	text-transform: uppercase;
	font-weight: bold;

	border-radius: 0px;
	text-shadow: none;
	padding: 6px 28px !important;
}
select {
    padding: 0px;
    margin: 0px;
    border: 1px solid #CCC;
    width: 120px;
    border-radius: 3px;
    overflow: hidden;
    background: #FFF url('<?php echo $CFG->wwwroot."/theme/ist/pix/arrowdown.gif";?>')  no-repeat scroll 98% 53%;
}
table thead tr th, table thead tr td {
    font-size: 14px !important;
    font-style: normal;
}
.usermenu .moodle-actionmenu .toggle-display .userbutton .usertext {
   
    color: #fff !important;
}
.navbar-inner .show {     background-color: #C14800 !important;     background-image: none;     background-repeat: repeat-x; }
</style>



