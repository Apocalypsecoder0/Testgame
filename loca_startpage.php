<?php

// Start page

require_once "loca.php";


    // "en"
    $LocaLang = "en";
    {
        loca_add("SERVERNAME" , "Game Open Source");
      
        loca_add("META_CHARSET" , "utf-8");
        loca_add("META_KEYWORDS" , "testGame, Browsergame, Onlinegame, Browsergames,new deisgn");
        loca_add("META_DESCRIPTION" , "Game - Top Browsergame .");

        loca_add("ERROR_0" , "OK");
        loca_add("ERROR_101" , "Player\'s name is already taken!");
        loca_add("ERROR_102" , "E-Mail-Address is already in use!");
        loca_add("ERROR_103" , "The name must be between 3 and 20 characters long!");
        loca_add("ERROR_104" , "You need to enter a valid e-mail-address!");
        loca_add("ERROR_105" , "Player\'s name OK");
        loca_add("ERROR_106" , "E-Mail-Address OK");
        loca_add("ERROR_107" , "Password must be at least 8 characters long!");
        loca_add("ERROR_108" , "Cannot register from same IP in next 10 minutes!");

        loca_add("TIP_201" , "Name in the game: <br />This is the name you use in the game. It is unique throughout the universe.");
        loca_add("TIP_202" , "E-Mail-Address: <br />Enter a valid E-Mail address to activate your account. You have 3 days to activate your account during those 3 days you are already able to play.");
        loca_add("TIP_203" , "");
        loca_add("TIP_204" , "T&C:<br /> Accept the T&C (Terms and Conditions) to be able to play OGame.");
        loca_add("TIP_205" , "Password:<br/>Your password works as a safety meassure when login in to your account. Do not give your password to anyone!");

        loca_add("MENU_START",       "Start");
        loca_add("MENU_ABOUT",       "About game");
        loca_add("MENU_PICTURES",    "Pictures");
        loca_add("MENU_REG",         "Join Now!");
        loca_add("MENU_BOARD",       "Board");
        loca_add("MENU_WIKI",        "Wiki");

        loca_add("LOGIN_LINK" , "Link Login");
        loca_add("LOGIN_NAME" , "Username");
        loca_add("LOGIN_PASS" , "Password");
        loca_add("LOGIN_CHOOSE_UNI" , "Choose a universe...");
        loca_add("LOGIN_UNI" , "Universe");
        loca_add("LOGIN_CONFIRM" , "By logging in, I accept the");
        loca_add("LOGIN_IMPRESSUM" , "T&C's");
        loca_add("LOGIN_REMIND" , "Forgot your password?");
        loca_add("LOGIN_NOTCHOSEN" , "You haven\'t chosen a universe.");

        loca_add("CHOOSELANG" , "Choose your language");
        loca_add("COPYRIGHT" , "All rights reserved.");
        loca_add("DOWN_RULES" , "Rules");
        loca_add("DOWN_IMPRINT" , "Imprint");
        loca_add("DOWN_TAC" , "T&C's");

        loca_add("HOME_TITLE",  "Welcome to Game");
        loca_add("HOME_TEXT1",  "<strong>Game</strong> is a <strong>strategic space simulation game</strong>with \n" .
              "<strong>thousands of players</strong> across the world competing with each other <strong>simultaneously</strong>. All you need to play is a standard web browser.");
        loca_add("HOME_TEXT2",  "Register now and enter the fantastic world of rts turn base mmorpg!");
        loca_add("HOME_BIGBUTTON",  "Play for free now!");

        loca_add("ABOUT_TITLE",  "What is OGame?");
        loca_add("ABOUT_TEXT1",  "OGame is a game of intergalactic conquest.");
        loca_add("ABOUT_TEXT2",  "You start out with just one undeveloped world and turn that into a <strong>mighty empire</strong> able to defend your hard earned colonies.");
        loca_add("ABOUT_TEXT3",  "Create an <strong>economic and military infrastructure</strong> to support your quest for the next greatest technological achievements.");
        loca_add("ABOUT_TEXT4",  "<strong>Wage war</strong> against other empires as you struggle with other players to gain the materials.");
        loca_add("ABOUT_TEXT5",  "<strong>Negotiate</strong> with other emperors and create an alliance or trade for much needed resources. ");
        loca_add("ABOUT_TEXT6",  "<strong>Build an armada</strong> to enforce your will throughout the universe.");
        loca_add("ABOUT_TEXT7",  "<strong>Hoard your resources</strong> behind an impregnable wall of planetary defences.");
        loca_add("ABOUT_TEXT8",  "Whatever you wish to do, <strong>OGame can let you do it.</strong>");
        loca_add("ABOUT_TEXT9",  "Will you terrorize the area around you? Or will you strike fear into the hearts of those who attack the helpless?");
        loca_add("ABOUT_STORY",  "Read the game Story");

        loca_add("STORY_TITLE", "Story");
        loca_add("STORY_HEAD", "The game Story");
        loca_add("STORY_TEXT", "
<p><img src=\"img/ogame_technokrat.jpg\" class=\"imageRight\"> This is the story of a species, a race - its our race, the humans.</p> <p >Interestingly enough the story has not yet happened, but it should still be told. Once in a time you will find that time runs in parallel, that everything that was in the past, forms the present as well as the present is the basis for the future. There has been found a way to visit the past without altering the future. Because one can only alter the future when living it for oneself. This might be hard to understand, but its true. Only when you know that something has happened, you can change it, because it then is part of one's own past. You will simply disappear from that point on, no changes will take place, because this is already the past.. your past.</p>
      <p >
       <img src=\"img/fight.gif\" class=\"imageRight\">
       The answer is very simple, it is for you come with us to build the future! Follow us, and see what YOU can do with a nation thats awaits a new emperor desperately ready to grow and succeed! You will have to put much work into this task, and the times wont always be peaceful, but it is up to you, to take part in this part of the universe and save your nation a respected seat among all the empires. Follow us through this time portal, and enjoy this world full of new things and an big future. It might be hard from time to time, it might be easy now and then, but your will and your power could create a powerful and prosperous nation. </p><p >I will leave you now... hoping you would join us... yet its your decision... Dare it! </p>
" );
        loca_add("STORY_JOIN", "Join now!");

        loca_add("PICS_TITLE", "Pictures");
        loca_add("PICS_SCREENSHOTS", "Screenshots");
        loca_add("PICS_WALLPAPERS", "Wallpapers");
        loca_add("PICS_WALL1", "Overview");
        loca_add("PICS_WALL2", "Buildings");
        loca_add("PICS_WALL3", "Shipyard");
        loca_add("PICS_WALL4", "Empire");

        loca_add("JOIN_TITLE", "Registration");
        loca_add("JOIN_HEAD", "In order to play you only have to enter a <strong>username</strong>, a <strong>password</strong> and an <strong>E-Mail address</strong> and <strong>proceed to read the terms and conditions</strong> before activating the check box about your agreement to them.");
        loca_add("JOIN_NAME", "Username:");
        loca_add("JOIN_EMAIL", "E-Mail-Address:");
        loca_add("JOIN_PASS", "Password:");
        loca_add("JOIN_ADVICE", "Universe:");
        loca_add("JOIN_TIP", "recommended");
        loca_add("JOIN_UNIS", "Specials of the universes");
        loca_add("JOIN_IACCEPT", "I accept the");
        loca_add("JOIN_TAC", "T&C's");
        loca_add("JOIN_REGISTER", "Join now!");

        loca_add("INSTALL_MDB", "Master Database Settings");
        loca_add("INSTALL_MDB_TIP", "The central database can be located on another server (usually in the same place where start page located) and stores information about all the universes, coupons and other general information.");
        loca_add("INSTALL_MDB_HOST", "Host");
        loca_add("INSTALL_MDB_USER", "User");
        loca_add("INSTALL_MDB_PASS", "Password");
        loca_add("INSTALL_MDB_NAME", "DB name");
        loca_add("INSTALL_INSTALL", "Install");
        loca_add("INSTALL_ERROR1", "Cannot save config file.");
        loca_add("INSTALL_DONE", "Install complete. Config file created.");
    }
