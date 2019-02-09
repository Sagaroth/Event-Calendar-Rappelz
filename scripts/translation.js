/*
    Rappelz Event Calendar - Make events with players
    Copyright (C) 2019  History of Rappelz

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

var linguJSON = {
            "languages": [
                {
                    "lang_name": "English",
                    "lang_code": "en",
                    "url_pattern": "?"
                },
                {
                    "lang_name": "Français",
                    "lang_code": "fr",
                    "url_pattern": "?"
                }
            ],
            "custom_lang_switcher_html": "<button id=\"langswitcher\" type=\"submit\" class=\"notranslate btn\"<a id=\"currlanglink\" href=\"\">[[linguCurrLang]]</a> <a href=\"[[linguTargetLangHref1]]\" class=\"targetlang\">[[linguTargetLang1]]</a><a href=\"[[linguTargetLangHref2]]\" class=\"targetlang\">[[linguTargetLang2]]</a></button>",
            "translated_segments": [
                {
                    "source": "Events (by the players)",
                    "target": "Events (par les joueurs)"
                },
                {
                    "source": "This page lists events that players plan to do. Do not hesitate to participate and save the next events in your calendar!",
                    "target": "Cette page recense des events que prévoient de faire les joueurs. Nhésitez pas à participer et à enregistrer les prochains évènements dans votre agenda !"
                },
                {
                    "source": "Description",
                    "target": "Description"
                },
                {
                    "source": "As mentioned above, the purpose of this page is to promote the events created by Rappelz players, to facilitate their communication, and to connect people who want to try to do so.",
                    "target": "Comme il est indiqué plus haut, le but de cette page est de promouvoir les event créés par les joueurs de Rappelz, de faciliter leur communication, et de mettre en relation des personnes voulant s'essayer à en faire."
                },
                {
                    "source": "The principle is simple. If you know what you want to do, click on the date of your event and fill out the form. If you need people, or are not confident enough to organize an event, you can look at the list on the right and use chat to communicate with other interested players.",
                    "target": "Le principe est simple. Si vous savez ce que vous voulez faire, cliquez sur la date de votre event et remplissez le formulaire. Si vous avez besoin de monde, ou n'êtes pas assez confiant pour organiser un event, vous pouvez regarder la liste à droite et utiliser le chat pour communiquer avec d'autres joueurs intéressés."
                },
                {
                    "source": "In the list of players on the right, it is advisable to put your nickname ig, so the communication will be easier!",
                    "target": "Dans la liste de joueurs à droite, il est conseillé de mettre votre pseudo ig, ainsi la communication sera plus facile !"
                },
                {
                    "source": "Good luck for the creation of your events !!!",
                    "target": "Bon courage pour la création de vos events !!!"
                },
                {
                    "source": "Event ideas",
                    "target": "Exemples d'event"
                },
                {
                    "source": "Name",
                    "target": "Nom"
                },
                {
                    "source": "She is crazy !",
                    "target": "Elle est folle !"
                },
                {
                    "source": "Almianeldriem lost her mind by dint of seeing rainbows everywhere ! Find her and stop her !",
                    "target": "Almianeldriem a pété une durite à force de voir des arcs-en-ciel de partout ! Trouvez-là et maîtrisez-la !"
                },
                {
                    "source": "Gesture Mimic",
                    "target": "Gesture Mimic"
                },
                {
                    "source": "The event organizer does a gesture action, and the candidates must reproduce it (or name it). Note that this may change depending on race.",
                    "target": "La personne de l'event fait une action gestuelle, et les candidats doivent la reproduire (ou la nommer). A noter que cela peut changer selon la race, peut-être plusieurs animateurs/persos pour event"
                },
                {
                    "source": "Hide and seek (reverse)",
                    "target": "Cache-cache inversé"
                },
                {
                    "source": "The leader must find the candidates on a field (eg lost island)",
                    "target": "L'animateur doit trouver les candidats sur un terrain (par exemple île)"
                },
                {
                    "source": "Catch the penguin!",
                    "target": "Chopez le pingouin !"
                },
                {
                    "source": "He escaped from the zoo! A person in penguin costume (or other, cat, cow -> to roast *-* ...) run from a point A to B, he must be caught (stun/seal ?) or kill before he reaches the point of arrival -> alternate version where the participants have a bow",
                    "target": "Il s'est échappé du zoo ! Une personne en costume de pingouin (ou autre, chat, vache -> à rôtir *-* ...) cours d'un point A à un point B (zig/zag, sans stuff), il faut le choper (stun/sceller) ou le tuer avant qu'il n'arrive au point d'arrivée -> version alternative où les participants on un arc (voir dans le chat dégât la première personne à toucher)"
                },
                {
                    "source": "Create an event type !",
                    "target": "Créer un type d'event !"
                },
                {
                    "source": "Event type creation form",
                    "target": "Création d'un type d'event"
                },
                {
                    "source": "Title",
                    "target": "Nom de l'event"
                },
                {
                    "source": "Choose a short name, eg: Hide and seek",
                    "target": "Choississez un nom court, ex: Cache-chache"
                },
                {
                    "source": "Your name",
                    "target": "Votre nom"
                },
                {
                    "source": "Your nickname ig",
                    "target": "Votre pseudo ig"
                },
                {
                    "source": "Describe your event shortly",
                    "target": "Décrivez votre event de manière claire concise"
                },
                {
                    "source": "Create my event type !",
                    "target": "Créer mon type d'event !"
                },
                {
                    "source": "Advice",
                    "target": "Conseils"
                },
                {
                    "source": "When you want to organize an event, do not hesitate to be several ! (the list on the right of the page is for that). It is not always easy to organize an event because there are several aspects to manage such as the communication on the date, the rules, the management of the participants (not necessarily easy, and you can have a lot of people messaging you during the event)",
                    "target": "Lorsque vous préparez un event, n'hésitez pas à être à plusieurs ! ( la liste sur la droite de la page sert à ça). Il n'est pas toujours facile d'organiser un event car il y a plusieurs aspects à gérer tels que la communication sur la date, les règles, la gestion des participants (pas forcément facile, et on peut recevoir beaucoup de mp lors du jeu)."
                },
                {
                    "source": "For <strong>prices</strong>, if you are new, you will not have necessarily donators. To see with <strong>HOR</strong> (<strong>TODO + players \"sponsors\"? System of \"ticket\" where the winner will go see the player?</strong>) Who can act as intermediary, or invite a person who wants to give but does not necessarily trust an unknown organizer (foresee any other possibility if it withdraws)",
                    "target": "Pour les <strong>lots</strong>, si vous êtes nouveaux, vous n'aurez pas forcément de donnateurs. A voir avec <strong>HOR</strong> (<strong>TODO + joueurs \"sponsors\" ? système de \"ticket\" où le gagnant ira voir le joueur ?</strong>) qui peut faire office d'intermédaire, ou alors inviter une personne qui veut donner mais n'a pas forcément confiance à remettre le lot en mains propres (prévoir tout de même une autre possibilité si elle se désiste)"
                },
                {
                    "source": "If you want to <strong>create an event</strong>, a new type of game, start with simple rules. Something that is not too complex or long (if it is successful you can bring variants). Also think of all the possibilities for why the event could fail (ex: on a hide and seek, a person who finds you can come back with a reroll ...)",
                    "target": "Si vous souhaitez <strong>créer un event</strong>, un nouveau jeu, préférrez des règles simples pour commencer. Quelque chose qui n'est pas complexe ou long (si il a du succès vous pourrez apporter des variantes). Pensez aussi à toutes les possibilités qui pourraient fausser l'event (ex: sur un cache-cache, une personne qui vous trouve peut très bien revenir avec un reroll...)"
                },
                {
                    "source": "Event creation form",
                    "target": "Création d'un event"
                },
                {
                    "source": "Event type",
                    "target": "Type d'event"
                },
                {
                    "source": "Organizer",
                    "target": "Organisateur"
                },
                {
                    "source": "Dates",
                    "target": "Dates"
                },
                {
                    "source": "Create my event",
                    "target": "Créer mon event !"
                },
                {
                    "source": "People looking for someone to create an event",
                    "target": "Personnes cherchant âme soeur pour créer un event"
                },
                {
                    "source": "<strong>Appreciated events</strong>",
                    "target": "<strong>Events voulus/appréciés</strong>"
                },
                {
                    "source": "Our friends the mobs 60%",
                    "target": "Nos amis les mobs 60%"
                },
                {
                    "source": "Hide and Seek 30%",
                    "target": "Cache-cache 30%"
                },
                {
                    "source": "Penguin 10%",
                    "target": "Pingouin 10%"
                },
                {
                    "source": "<strong>Save event in my calendar !</strong>",
                    "target": "<strong>Enregistrer l'event dans mon calendrier !</strong>"
                },
                {
                    "source": "Cats in box",
                    "target": "Chats en boîte"
                },
                {
                    "source": "meeow, meeow !!",
                    "target": "miaou, miaouu !!"
                },
                {
                    "source": "black cat • 51 min",
                    "target": "chat noir • 51 min"
                },
                {
                    "source": "Chicken • 51 min",
                    "target": "Poulet • 51 min"
                },
                {
                    "source": "Chicken",
                    "target": "Poulet"
                },
                {
                    "source": "couldn't we do an event with tanks crushing chickens ?",
                    "target": "on pourrait pas faire un event avec des tank qui écrasent des poulets ? ou des types qui mitraillent des poulets ?"
                },
                {
                    "source": "Send",
                    "target": "Envoyer"
                },
                {
                    "source": "stop chatting like that nasty animal ! *-*",
                    "target": "stop causer comme ça sale bête ! *-*"
                }
            ]
        };