/*
LICENSE AND TERMS OF USE

Lingumania.js is licensed under the terms of https://creativecommons.org/licenses/by-nd/3.0/ license, 
which means it can be used freely on commercial or non commercial websites as long as the language switcher links back to www.lingumania.com. 
You may modify the code only if you use it to translate your own website. In all other cases, modifications or redistribution, 
whether standalone or as part of another javascript, are not permitted without prior consent of the copyright owners.
*/

(function (w, d, u) {
    var translationLang;
    if (getQSParameterByName("lang", w.location.href))
        translationLang = getQSParameterByName("lang", w.location.href);
    else if (parseURL(w.location.href, false).substring(0, 4).replace(/\//g, '').length == 2)
        translationLang = parseURL(w.location.href, false).substring(0, 4).replace(/\//g, '');
    else if (parseURL(w.location.href, true).substring(0, parseURL(w.location.href, true).indexOf('.')).length == 2)
        translationLang = parseURL(w.location.href, true).substring(0, parseURL(w.location.href, true).indexOf('.'));
    else if (parseURL(w.location.href, true).substring(parseURL(w.location.href, true).lastIndexOf('.') + 1, parseURL(w.location.href, true).length).length == 2)
        translationLang = parseURL(w.location.href, true).substring(parseURL(w.location.href, true).lastIndexOf('.') + 1, parseURL(w.location.href, true).length);


    var NodeFilter = {
        FILTER_ACCEPT: 1,
        FILTER_REJECT: 2,
        FILTER_SKIP: 3,
        SHOW_ALL: -1,
        SHOW_ELEMENT: 1,
        SHOW_ATTRIBUTE: 2,
        SHOW_TEXT: 4,
        SHOW_CDATA_SECTION: 8,
        SHOW_ENTITY_REFERENCE: 16,
        SHOW_ENTITY: 32,
        SHOW_PROCESSING_INSTRUCTIONS: 64,
        SHOW_COMMENT: 128,
        SHOW_DOCUMENT: 256,
        SHOW_DOCUMENT_TYPE: 512,
        SHOW_DOCUMENT_FRAGMENT: 1024,
        SHOW_NOTATION: 2048
    };

    var TreeWalker = function (root, whatToShow, filter, expandEntityReferences) {
        this.root = root;
        this.whatToShow = whatToShow;
        this.filter = filter;
        this.expandEntityReferences = expandEntityReferences;
        this.currentNode = root;
        this.NodeFilter = NodeFilter;
    };

    TreeWalker.prototype.parentNode = function () {
        var testNode = this.currentNode;

        do {
            if (
                testNode !== this.root &&
                testNode.parentNode &&
                testNode.parentNode !== this.root
            ) {
                testNode = testNode.parentNode;
            } else {
                return null;
            }
        } while (this._getFilteredStatus(testNode) !== this.NodeFilter.FILTER_ACCEPT);
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype.firstChild = function () {
        var testNode = this.currentNode.firstChild;

        while (testNode) {
            if (this._getFilteredStatus(testNode) === this.NodeFilter.FILTER_ACCEPT) {
                break;
            }
            testNode = testNode.nextSibling;
        }
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype.lastChild = function () {
        var testNode = this.currentNode.lastChild;

        while (testNode) {
            if (this._getFilteredStatus(testNode) === this.NodeFilter.FILTER_ACCEPT) {
                break;
            }
            testNode = testNode.previousSibling;
        }
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype.nextNode = function () {
        var testNode = this.currentNode;

        while (testNode) {
            if (testNode.childNodes.length !== 0) {
                testNode = testNode.firstChild;
            } else if (testNode.nextSibling) {
                testNode = testNode.nextSibling;
            } else {
                while (testNode) {
                    if (testNode.parentNode && testNode.parentNode !== this.root) {
                        if (testNode.parentNode.nextSibling) {
                            testNode = testNode.parentNode.nextSibling;
                            break;
                        } else {
                            testNode = testNode.parentNode;
                        }
                    }
                    else return null;
                }
            }
            if (testNode && this._getFilteredStatus(testNode) === this.NodeFilter.FILTER_ACCEPT) {
                break;
            }
        }
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype.previousNode = function () {
        var testNode = this.currentNode;

        while (testNode) {
            if (testNode.previousSibling) {
                testNode = testNode.previousSibling;
                while (testNode.lastChild) {
                    testNode = testNode.lastChild;
                }
            }
            else {
                if (testNode.parentNode && testNode.parentNode !== this.root) {
                    testNode = testNode.parentNode;
                }
                else testNode = null;
            }
            if (testNode && this._getFilteredStatus(testNode) === this.NodeFilter.FILTER_ACCEPT) {
                break;
            }
        }
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype.nextSibling = function () {
        var testNode = this.currentNode;

        while (testNode) {
            (testNode.nextSibling) && (testNode = testNode.nextSibling);
            if (this._getFilteredStatus(testNode) === this.NodeFilter.FILTER_ACCEPT) {
                break;
            }
        }
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype.previousSibling = function () {
        var testNode = this.currentNode;

        while (testNode) {
            (testNode.previousSibling) && (testNode = testNode.previousSibling);
            if (this._getFilteredStatus(testNode) == this.NodeFilter.FILTER_ACCEPT) {
                break;
            }
        }
        (testNode) && (this.currentNode = testNode);

        return testNode;
    };

    TreeWalker.prototype._getFilteredStatus = function (node) {
        var mask = ({
            /* ELEMENT_NODE */ 1: this.NodeFilter.SHOW_ELEMENT,
            /* ATTRIBUTE_NODE */ 2: this.NodeFilter.SHOW_ATTRIBUTE,
            /* TEXT_NODE */ 3: this.NodeFilter.SHOW_TEXT,
            /* CDATA_SECTION_NODE */ 4: this.NodeFilter.SHOW_CDATA_SECTION,
            /* ENTITY_REFERENCE_NODE */ 5: this.NodeFilter.SHOW_ENTITY_REFERENCE,
            /* ENTITY_NODE */ 6: this.NodeFilter.SHOW_PROCESSING_INSTRUCTION,
            /* PROCESSING_INSTRUCTION_NODE */ 7: this.NodeFilter.SHOW_PROCESSING_INSTRUCTION,
            /* COMMENT_NODE */ 8: this.NodeFilter.SHOW_COMMENT,
            /* DOCUMENT_NODE */ 9: this.NodeFilter.SHOW_DOCUMENT,
            /* DOCUMENT_TYPE_NODE */ 10: this.NodeFilter.SHOW_DOCUMENT_TYPE,
            /* DOCUMENT_FRAGMENT_NODE */ 11: this.NodeFilter.SHOW_DOCUMENT_FRAGMENT,
            /* NOTATION_NODE */ 12: this.NodeFilter.SHOW_NOTATION
        })[node.nodeType];

        return (
            (mask && (this.whatToShow & mask) == 0) ?
                this.NodeFilter.FILTER_REJECT :
                (this.filter && this.filter.acceptNode) ?
                    this.filter.acceptNode(node) :
                    this.NodeFilter.FILTER_ACCEPT
        );
    };

    if (!d.createTreeWalker) {
        d.createTreeWalker = function (root, whatToShow, filter, expandEntityReferences) {
            return new TreeWalker(root, whatToShow, filter, expandEntityReferences);
        };
    }

    if (typeof String.prototype.trim !== 'function') {
        String.prototype.trim = function () {
            return this.replace(/^\s+|\s+$/g, '');
        }
    }


    String.prototype.startsWith = function (searchString) {
        return this.substr(0, searchString.length) === searchString;
    };
    String.prototype.endsWith = function (suffix) {

        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };


    function parseURL(url, domainOnly) {
        var domain;
        url = decodeURIComponent(url);
        if (url.indexOf("://") > -1) {
            domain = url.split('/')[2];
            if (!domainOnly)
                domain = url.split('/')[0] + "//" + url.split('/')[2];
        }
        else
            domain = url.split('/')[0];

        if (domainOnly)
            return domain;
        else
            return url.replace(domain, '');
    }

    function getQSParameterByName(name, searchString) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(searchString);
        if (results == null)
            return "";
        else
            return results[1];
    }

    function getElementsByTagNames(tags) {
        var elements = [];

        for (var i = 0, n = tags.length; i < n; i++) {
            var divs = d.getElementsByTagName(tags[i]);
            for (var j = 0; j < divs.length; j++) {
                elements.push(divs[j]);
            }
        }

        return elements;
    };

    function isTranslatableSegment(html) {

        var foundPunctuation = html.match(/^(.|,|;|:|«|»|·|&|=|\/|\$|€|£|\(|\)|\*|\-|\+|\||\$-\/:-?{-~||\t|\r|\n|\d|\s)+$/gim);
        if (foundPunctuation) {
            var foundNonPunctuationChars = html.match(/[^.,;:€£«»·&=\/\$\(\)\*\-\+\|\t\r\n\d\s]/gim);
            if (!foundNonPunctuationChars)
                return false;
        }

        return true;
    }

    function rewriteUrl(link, absoluteLink, translationLang, url_pattern) {
        
        // EDIT Sorröw avoid using the default button (hidden in css) and remove wrong replace in href buttons 
        return; 

        if (url_pattern == '?') {
            var fragment;
            if (link.attributes["href"].value.indexOf('#') != -1) {
                fragment = link.attributes["href"].value.split('#')[1];
                link.attributes["href"].value = link.attributes["href"].value.replace('#' + fragment, '');
            }

            if (getQSParameterByName("lang", link.attributes["href"].value))
                link.attributes["href"].value = link.attributes["href"].value.toLowerCase().replace("lang=" + getQSParameterByName("lang", link.attributes["href"].value), "lang=" + translationLang);
            else if (link.attributes["href"].value.indexOf('?') != -1)
                link.attributes["href"].value += '&lang=' + translationLang;
            else
                link.attributes["href"].value += '?lang=' + translationLang;

            if (fragment)
                link.attributes["href"].value += '#' + fragment;
        } else if (url_pattern == '/') {
            if (parseURL(absoluteLink, false).substring(0, 4).replace(/\//g, '').toLowerCase() == translationLang)
                link.attributes["href"].value = absoluteLink.split('/')[0] + '//' + parseURL(absoluteLink, true) + parseURL(absoluteLink, false);

            else
                link.attributes["href"].value = absoluteLink.split('/')[0] + '//' + parseURL(absoluteLink, true) + '/' + translationLang + parseURL(absoluteLink, false);
        } else
            link.attributes["href"].value = absoluteLink.split('/')[0] + '//' + url_pattern + parseURL(absoluteLink, false);
    }

    function encodeAllSpecialTags(html) {

        html = html.replace(/<b>/gim, "&lt;b&gt;").replace(/<\/b>/gim, "&lt;/b&gt;").replace(/<i>/gim, "&lt;i&gt;").replace(/<\/i>/gim, "&lt;/i&gt;").replace(/<u>/gim, "&lt;u&gt;").replace(/<\/u>/gim, "&lt;/u&gt;").replace(/<em>/gim, "&lt;em&gt;").replace(/<\/em>/gim, "&lt;/em&gt;").replace(/<\/strong>/gim, "&lt;/strong&gt;").replace(/<\/abbr>/gim, "&lt;/abbr&gt;").replace(/<\/sub>/gim, "&lt;/sub&gt;").replace(/<\/sup>/gim, "&lt;/sup&gt;").replace(/<\/big>/gim, "&lt;/big&gt;").replace(/<\/small>/gim, "&lt;/small&gt;");

        var searchText = /<b\s[^>]*>/gim;
        var matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<i\s[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<u\s[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<em\s[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<strong[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<abbr[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<sub[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<sup[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<big[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        searchText = /<small[^>]*>/gim;
        matches = searchText.exec(html);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                html = html.replace(searchText, "&lt;" + matches[i].substring(1, matches[i].length - 1).toLowerCase() + "&gt;");
            }
        }

        return html;
    }

    function translateDOM() {
        if (linguJSON) {
            var isTranslated = false;
            var url_pattern = "?";
            var langMenu = d.createElement("div");
            langMenu.id = "lingumania_langswitcher";
            langMenu.className = "notranslate";
            var customLangMenu = d.createElement("span");
            var customLangMenuHtml = linguJSON.custom_lang_switcher_html;

            var languages = linguJSON.languages;
            if (languages.length > 1) {
                var sourceLang = languages[0];
                if (sourceLang.url_pattern)
                    url_pattern = sourceLang.url_pattern;
                var menuHeight = 0;
                if (translationLang == undefined)
                    translationLang = sourceLang.lang_code;
                var currlangcode = translationLang != '' ? translationLang : sourceLang.lang_code;
                var j = 1;
                for (var i = 0; i < languages.length; i++) {
                    if (languages[i].lang_code != currlangcode) {
                        var href = w.location.protocol + '//' + languages[i].url_pattern + parseURL(w.location.href, false);

                        if (!languages[i].url_pattern || languages[i].url_pattern == '?') {
                            var fragment;
                            if (w.location.href.indexOf('#') != -1) {
                                fragment = w.location.href.split('#')[1];
                                href = w.location.href.replace('#' + fragment, '');
                            }

                            if (getQSParameterByName("lang", w.location.href))
                                href = w.location.href.toLowerCase().replace("lang=" + getQSParameterByName("lang", w.location.href), "lang=" + languages[i].lang_code);
                            else if (w.location.href.indexOf('?') != -1)
                                href = w.location.href + '&lang=' + languages[i].lang_code;
                            else
                                href = w.location.href + '?lang=' + languages[i].lang_code;

                        } else if (languages[i].url_pattern == '/') {
                            if (parseURL(w.location.href, false).substring(0, 4).replace(/\//g, '').toLowerCase().length == 2)
                                href = w.location.protocol + '//' + parseURL(w.location.href, true) + parseURL(w.location.href, false).replace(parseURL(w.location.href, false).substring(0, 4), '/' + languages[i].lang_code + '/');
                            else
                                href = w.location.protocol + '//' + parseURL(w.location.href, true) + '/' + languages[i].lang_code + parseURL(w.location.href, false);
                        }

                        if (linguJSON.custom_lang_switcher_html && linguJSON.custom_lang_switcher_container_id) {
                            customLangMenuHtml = customLangMenuHtml.replace('[[linguTargetLang' + j + ']]', languages[i].lang_name);
                            customLangMenuHtml = customLangMenuHtml.replace('[[linguTargetLangHref' + j + ']]', href);
                        } else {
                            var langItem = d.createElement("a");
                            langItem.innerHTML = languages[i].lang_name;
                            langItem.className = "lingumania_target";
                            langItem.href = href;
                            langMenu.appendChild(langItem);
                        }
                        j++;
                    } else {
                        if (linguJSON.custom_lang_switcher_html && linguJSON.custom_lang_switcher_container_id) {
                            customLangMenuHtml = customLangMenuHtml.replace('[[linguCurrLang]]', languages[i].lang_name);
                        } else {
                            var currlangItem = d.createElement("a");
                            currlangItem.id = "lingumania_currentlanglink";
                            currlangItem.href = "";
                            currlangItem.innerHTML = languages[i].lang_name;
                            langMenu.insertBefore(currlangItem, langMenu.firstChild);
                        }
                        if (languages[i].url_pattern)
                            url_pattern = languages[i].url_pattern;
                    }
                    menuHeight += 30;
                }

                var translateNowItem = d.createElement("a");
                translateNowItem.className = "lingumania_poweredby";
                translateNowItem.target = "_blank";
                translateNowItem.href = "http://www.lingumania.com";
                translateNowItem.innerHTML = "Translated Websites<br />Powered by Lingumania";
                langMenu.appendChild(translateNowItem);
                menuHeight += 30;
                if (linguJSON.custom_lang_switcher_html && linguJSON.custom_lang_switcher_container_id) {
                    translateNowItem.id = 'lingumania_custom_id';

                    var frag = d.createDocumentFragment();
                    customLangMenu.innerHTML = customLangMenuHtml;

                    while (customLangMenu.firstChild) {
                        frag.appendChild(customLangMenu.firstChild);
                    }
                    menuHeight = 30;
                }

                if (langMenu.addEventListener) {
                    langMenu.addEventListener("mouseover", function (event) {
                        d.getElementById('lingumania_langswitcher').style.height = menuHeight + 'px';
                    });
                    langMenu.addEventListener("mouseout", function (event) {
                        setTimeout(function () { d.getElementById('lingumania_langswitcher').style.height = '30px'; }, 1000)
                    });
                } else {
                    langMenu.attachEvent("onmouseover", function (event) {
                        d.getElementById('lingumania_langswitcher').style.height = menuHeight + 'px';
                    });
                    langMenu.attachEvent("onmouseout", function (event) {
                        setTimeout(function () { d.getElementById('lingumania_langswitcher').style.height = '30px'; }, 1000)
                    });
                }
                var customMenuContainer = d.getElementById(linguJSON.custom_lang_switcher_container_id);
                if (!linguJSON.translated_pages) {
                    isTranslated = true;
                    d.body.insertBefore(langMenu, d.body.firstChild);

                    if (linguJSON.custom_lang_switcher_html && linguJSON.custom_lang_switcher_container_id && customMenuContainer) {
                        while (customMenuContainer.firstChild) {
                            customMenuContainer.removeChild(customMenuContainer.firstChild);
                        }
                        customMenuContainer.appendChild(frag);
                    }
                }
                else {
                    for (var i = 0; i < linguJSON.translated_pages.length; i++) {
                        var comparableLink = createComparableLink(w.location.href, languages);
                        if (comparableLink.replace(currlangcode, '').replace('//', '/') == linguJSON.translated_pages[i].slug.toLowerCase()) {
                            isTranslated = true;
                            break;
                        }
                    }

                    if (isTranslated) {
                        d.body.insertBefore(langMenu, d.body.firstChild);

                        if (linguJSON.custom_lang_switcher_html && linguJSON.custom_lang_switcher_container_id && customMenuContainer) {
                            while (customMenuContainer.firstChild) {
                                customMenuContainer.removeChild(customMenuContainer.firstChild);
                            }
                            customMenuContainer.appendChild(frag);
                        }
                    }
                }
            }

            if (linguJSON.translated_segments && linguJSON.translated_segments.length > 0 && isTranslated && currlangcode != sourceLang.lang_code) {
                var translatedSegments = linguJSON.translated_segments;

                var specialTags = getElementsByTagNames(['b', 'u', 'i', 'strong', 'em', 'abbr', 'sub', 'sup', 'big', 'small']);
                for (var i = 0; i < specialTags.length; i++) {
                    if (specialTags[i].parentNode)
                        specialTags[i].parentNode.innerHTML = encodeAllSpecialTags(specialTags[i].parentNode.innerHTML);
                }

                var node, nodes = [], fragments = [], linkTranslations = [];
                var domWalker = d.createTreeWalker(d.getElementsByTagName('html')[0], NodeFilter.SHOW_ALL, null, false);

                while (node = domWalker.nextNode()) {
                    if (node.nodeValue != null) {
                        if (!isTranslatableSegment(node.nodeValue.trim()))
                            continue;

                        var canBeTranslated = true;
                        var current = node;
                        while (canBeTranslated && current.parentNode) {
                            current = current.parentNode;
                            if (current.nodeName == "STYLE") {
                                canBeTranslated = false;
                            } else if (current.attributes) {
                                for (var i = 0; i < current.attributes.length; i++) {
                                    if (current.attributes[i].value == "notranslate")
                                        canBeTranslated = false;
                                }
                            }
                        }

                        if (canBeTranslated) {
                            try {

                                var startingWhiteSpaceRegex = /^\s+/gim;
                                var startingWhiteSpaceMatches = startingWhiteSpaceRegex.exec(node.nodeValue);
                                var endingWhiteSpaceRegex = /\s+$/gim;
                                var endingWhiteSpaceMatches = endingWhiteSpaceRegex.exec(node.nodeValue);

                                for (var i = 0; i < translatedSegments.length; i++) {
                                    if (translatedSegments[i].target == undefined) {
                                        if (eval('translatedSegments[i].target_' + currlangcode))
                                            translatedSegments[i].target = eval('translatedSegments[i].target_' + currlangcode);
                                    }

                                    if (translatedSegments[i].source == node.nodeValue.trim() && translatedSegments[i].target) {

                                        var target = translatedSegments[i].target;

                                        if (startingWhiteSpaceMatches)
                                            target = startingWhiteSpaceMatches[0] + target;

                                        if (endingWhiteSpaceMatches)
                                            target += endingWhiteSpaceMatches[0];

                                        if (target.match(/<\/?\w+((\s+\w+(\s*=\s*(?:".*?"|'.*?'|[\^'">\s]+))?)+\s*|\s*)\/?>/gim)) {

                                            var wrap = d.createElement('span');
                                            var frag = d.createDocumentFragment();
                                            wrap.innerHTML = target.replace(/\\"/g, '"');

                                            while (wrap.firstChild) {
                                                frag.appendChild(wrap.firstChild);
                                            }
                                            nodes.push(node);
                                            fragments.push(frag);
                                        }
                                        else {
                                            node.nodeValue = target;
                                        }
                                        break;
                                    }
                                }

                            } catch (ex) {

                            }
                        }



                        if (node.nodeValue.match(/(<\/b|<b\s[^>]*>|<\/u>|<u\s[^>]*>|<\/i>|<i\s[^>]*>|<\/strong>|<strong[^>]*>|<\/em>|<em\s[^>]*>|<\/abbr>|<abbr[^>]*>|<\/sub>|<sub[^>]*>|<\/sup>|<sup[^>]*>|<\/big>|<big[^>]*>|<\/small>|<small[^>]*>)/gim)) {
                            var wrap = d.createElement('span');
                            var frag = d.createDocumentFragment();
                            wrap.innerHTML = node.nodeValue;

                            while (wrap.firstChild) {
                                frag.appendChild(wrap.firstChild);
                            }
                            nodes.push(node);
                            fragments.push(frag);
                        }

                    }
                }

                var inputs = d.getElementsByTagName('input');
                for (var i = 0; i < inputs.length; i++) {
                    var input = inputs[i];
                    if (isTranslatableSegment(input.value.trim())) {
                        for (var j = 0; j < translatedSegments.length; j++) {
                            if (translatedSegments[j].source == input.value.trim()) {
                                input.value = translatedSegments[j].target;
                                break;
                            }
                        }
                    }
                }

                var imgs = d.getElementsByTagName('img');
                for (var i = 0; i < imgs.length; i++) {
                    var img = imgs[i];
                    if (img.attributes["alt"] && isTranslatableSegment(img.attributes["alt"].value.trim())) {
                        for (var j = 0; j < translatedSegments.length; j++) {
                            if (translatedSegments[j].source == img.attributes["alt"].value.trim()) {
                                img.attributes["alt"].value = translatedSegments[j].target;
                                break;
                            }
                        }
                    }
                }

                var metas = d.getElementsByTagName('meta');
                for (var i = 0; i < metas.length; i++) {
                    var meta = metas[i];
                    if (meta.attributes["content"]) {
                        for (var j = 0; j < translatedSegments.length; j++) {
                            if (translatedSegments[j].source == meta.attributes["content"].value.trim()) {
                                meta.attributes["content"].value = translatedSegments[j].target;
                                break;
                            }
                        }
                    }
                }

                for (var i = 0; i < translatedSegments.length; i++) {
                    if (translatedSegments[i].target == undefined) {
                        if (eval('translatedSegments[i].target_' + currlangcode))
                            translatedSegments[i].target = eval('translatedSegments[i].target_' + currlangcode);
                    }
                    if (translatedSegments[i].target && translatedSegments[i].target.startsWith('http'))
                        linkTranslations.push(translatedSegments[i]);
                }

                var links = d.getElementsByTagName('a');
                for (var i = 0; i < links.length; i++) {
                    var link = links[i];
                    if (link.attributes["href"] && link.parentNode.className != 'notranslate') {


                        for (var j = 0; j < linkTranslations.length; j++) {
                            if (linkTranslations[j].source.trim() == link.attributes["href"].value.trim().replace('/../', '/')) {
                                link.attributes["href"].value = linkTranslations[j].target;
                                break;
                            }
                        }


                        if (link.attributes["href"].value.indexOf(parseURL(w.location.href, true)) != -1 || link.attributes["href"].value.indexOf(sourceLang.url_pattern) != -1 || !link.attributes["href"].value.toLowerCase().startsWith('http')) {
                            var absoluteLink = link.attributes["href"].value;


                            if (!link.attributes["href"].value.startsWith('http') && (link.attributes["href"].value.indexOf(parseURL(w.location.href, true)) == -1 || link.attributes["href"].value.indexOf(sourceLang.url_pattern) != -1)) {
                                var el = d.createElement('div');
                                el.innerHTML = '<a href="' + link.attributes["href"].value.split('&').join('&amp;').split('<').join('&lt;').split('"').join('&quot;') + '">x</a>';
                                absoluteLink = el.firstChild.href;
                            }

                            for (var j = 0; j < linkTranslations.length; j++) {
                                var comparableLink = createComparableLink(absoluteLink.trim().replace('/../', '/'), languages);
                                if (parseURL(linkTranslations[j].source.trim(), false) == comparableLink) {
                                    link.attributes["href"].value = linkTranslations[j].target;
                                    break;
                                }
                            }

                            if (!linguJSON.translated_pages) {

                                rewriteUrl(link, absoluteLink, translationLang, url_pattern);
                            } else {

                                var comparableLink = createComparableLink(absoluteLink, languages);
                                for (var j = 0; j < linguJSON.translated_pages.length; j++) {
                                    if (comparableLink == linguJSON.translated_pages[j].slug.toLowerCase()) {
                                        rewriteUrl(link, absoluteLink, translationLang, url_pattern);
                                        break;
                                    }
                                }
                            }

                        }
                    }
                }


                for (var i = 0; i < nodes.length; i++) {
                    if (nodes[i].parentNode)
                        nodes[i].parentNode.replaceChild(fragments[i], nodes[i]);
                }

            }

            if (linguJSON.translated_image_segments && linguJSON.translated_image_segments.length > 0 && isTranslated && currlangcode != sourceLang.lang_code) {
                var translatedImageSegments = linguJSON.translated_image_segments;

                var imgs = d.getElementsByTagName('img');
                for (var i = 0; i < imgs.length; i++) {
                    var img = imgs[i];
                    if (img.attributes["src"]) {
                        for (var j = 0; j < translatedImageSegments.length; j++) {
                            if (translatedImageSegments[j].img_target == undefined) {
                                if (eval('translatedImageSegments[j].img_target_' + currlangcode))
                                    translatedImageSegments[j].img_target = eval('translatedImageSegments[j].img_target_' + currlangcode);
                            }
                            if (translatedImageSegments[j].img_source.replace('http://', '').replace('https://', '').endsWith(img.attributes["src"].value.trim().replace('http://', '').replace('https://', ''))) {
                                img.attributes["src"].value = translatedImageSegments[j].img_target;
                                break;
                            }
                        }
                    }
                }
            }
        }

        d.body.style.visibility = 'visible';
    }

    function createComparableLink(absoluteLink, languages) {
        var comparableLink = absoluteLink.replace('http://', '').replace('https://', '').toLowerCase();

        if (comparableLink == parseURL(w.location.href, true) || comparableLink == languages[0].url_pattern)
            comparableLink = '/';

        comparableLink = comparableLink.replace(parseURL(w.location.href, true), '');

        if (languages[0].url_pattern != '?')
            comparableLink = comparableLink.replace(languages[0].url_pattern, '');

        if (comparableLink.indexOf('?') != -1)
            comparableLink = comparableLink.substring(0, comparableLink.indexOf('?'));

        if (comparableLink.lastIndexOf('/') == comparableLink.length - 1)
            comparableLink = comparableLink.substring(0, comparableLink.length - 1);

        if (!comparableLink.startsWith('/'))
            comparableLink = '/' + comparableLink;

        return comparableLink;
    }

    var linguLoader = function () {

        var cssCode = "a.lingumania_target, a.lingumania_poweredby { display: none; background-color: #999; } #lingumania_custom_id { display: block; color: #fff; display: block; width: 160px; padding: 5px; text-decoration: none; } a.lingumania_target:hover, a.lingumania_poweredby:hover { background-color: #000; } #lingumania_langswitcher{ position: absolute; top: 0px; right: 0px; z-index: 100001; text-transform: uppercase; text-align: left; color: #fff; font-size: 12px; line-height: 18px; } #lingumania_langswitcher:hover a { display: block; position: relative; z-index: 100002; float: right; width: 160px; padding: 5px; clear: both; color: #fff; text-decoration: none; } a#lingumania_currentlanglink { display: block; width: 160px; padding: 5px; background: #999 url('//az596610.vo.msecnd.net/arrow-down-black.png') right top no-repeat; color: #fff; font-weight: bold; text-decoration: none; }  .lingumania_poweredby { background: url('//az596610.vo.msecnd.net/lingumania.png') right center no-repeat; border-top: 1px solid #808080; font-size: 9px; line-height: 12px; }";
        var style = d.createElement('style');
        style.type = "text/css";
        if (style.styleSheet)
            style.styleSheet.cssText = cssCode;
        else
            style.innerHTML = cssCode;

        d.body.insertBefore(style, d.body.firstChild);

        translateDOM();
    };

    w.addEventListener ? w.addEventListener("load", linguLoader, false) : w.attachEvent("onload", linguLoader);
}(window, document));