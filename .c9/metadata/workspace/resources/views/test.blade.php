{"filter":false,"title":"test.blade.php","tooltip":"/resources/views/test.blade.php","ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":0,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"hash":"67452301efcdab8998badcfe10325476c3d2e1f0","undoManager":{"mark":1,"position":1,"stack":[[{"group":"doc","deltas":[{"start":{"row":0,"column":0},"end":{"row":0,"column":5020},"action":"insert","lines":["<script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^${}()|\\[\\]\\/\\\\])/g, idRx = /\\bsf-dump-\\d+-ref[012]\\w+\\b/; doc.documentElement.firstChild.appendChild(refStyle); function toggle(a) { var s = a.nextSibling || {}; if ('sf-dump-compact' == s.className) { a.lastChild.innerHTML = '&#9660;'; s.className = 'sf-dump-expanded'; } else if ('sf-dump-expanded' == s.className) { a.lastChild.innerHTML = '&#9654;'; s.className = 'sf-dump-compact'; } else { return false; } return true; }; return function (root) { root = doc.getElementById(root); function a(e, f) { root.addEventListener(e, function (e) { if ('A' == e.target.tagName) { f(e.target, e); } else if ('A' == e.target.parentNode.tagName) { f(e.target.parentNode, e); } }); }; root.addEventListener('mouseover', function (e) { if ('' != refStyle.innerHTML) { refStyle.innerHTML = ''; } }); a('mouseover', function (a) { if (a = idRx.exec(a.className)) { refStyle.innerHTML = 'pre.sf-dump .'+a[0]+'{background-color: #B729D9; color: #FFF !important; border-radius: 2px}'; } }); a('click', function (a, e) { if (/\\bsf-dump-toggle\\b/.test(a.className)) { e.preventDefault(); if (!toggle(a)) { var r = doc.getElementById(a.getAttribute('href').substr(1)), s = r.previousSibling, f = r.parentNode, t = a.parentNode; t.replaceChild(r, a); f.replaceChild(a, s); t.insertBefore(s, r); f = f.firstChild.nodeValue.match(indentRx); t = t.firstChild.nodeValue.match(indentRx); if (f && t && f[0] !== t[0]) { r.innerHTML = r.innerHTML.replace(new RegExp('^'+f[0].replace(rxEsc, '\\\\$1'), 'mg'), t[0]); } if ('sf-dump-compact' == r.className) { toggle(s); } } } }); var indentRx = new RegExp('^('+(root.getAttribute('data-indent-pad') || ' ').replace(rxEsc, '\\\\$1')+')+', 'm'), elt = root.getElementsByTagName('A'), len = elt.length, i = 0, t = []; while (i < len) t.push(elt[i++]); elt = root.getElementsByTagName('SAMP'); len = elt.length; i = 0; while (i < len) t.push(elt[i++]); root = t; len = t.length; i = t = 0; while (i < len) { elt = root[i]; if (\"SAMP\" == elt.tagName) { elt.className = \"sf-dump-expanded\"; a = elt.previousSibling || {}; if ('A' != a.tagName) { a = doc.createElement('A'); a.className = 'sf-dump-ref'; elt.parentNode.insertBefore(a, elt); } else { a.innerHTML += ' '; } a.innerHTML += '<span>&#9660;</span>'; a.className += ' sf-dump-toggle'; if ('sf-dump' != elt.parentNode.className) { toggle(a); } } else if (\"sf-dump-ref\" == elt.className && (a = elt.getAttribute('href'))) { a = a.substr(1); elt.className += ' '+a; if (/[\\[{]$/.test(elt.previousSibling.nodeValue)) { a = a != elt.nextSibling.id && doc.getElementById(a); try { t = a.nextSibling; elt.appendChild(a); t.parentNode.insertBefore(a, t); if (/^[@#]/.test(elt.innerHTML)) { elt.innerHTML += ' <span>&#9654;</span>'; } else { elt.innerHTML = '<span>&#9654;</span>'; elt.className = 'sf-dump-ref'; } elt.className += ' sf-dump-toggle'; } catch (e) { if ('&' == elt.innerHTML.charAt(0)) { elt.innerHTML = '&#8230;'; elt.className = 'sf-dump-ref'; } } } } ++i; } }; })(document); </script> <style> pre.sf-dump { display: block; white-space: pre; padding: 5px; } pre.sf-dump span { display: inline; } pre.sf-dump .sf-dump-compact { display: none; } pre.sf-dump abbr { text-decoration: none; border: none; cursor: help; } pre.sf-dump a { text-decoration: none; cursor: pointer; border: 0; outline: none; }pre.sf-dump{background-color:#fff; color:#222; line-height:1.2em; font-weight:normal; font:12px Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:100000}pre.sf-dump .sf-dump-num{color:#a71d5d}pre.sf-dump .sf-dump-const{color:#795da3}pre.sf-dump .sf-dump-str{color:#df5000}pre.sf-dump .sf-dump-cchr{color:#222}pre.sf-dump .sf-dump-note{color:#a71d5d}pre.sf-dump .sf-dump-ref{color:#a0a0a0}pre.sf-dump .sf-dump-public{color:#795da3}pre.sf-dump .sf-dump-protected{color:#795da3}pre.sf-dump .sf-dump-private{color:#795da3}pre.sf-dump .sf-dump-meta{color:#b729d9}pre.sf-dump .sf-dump-key{color:#df5000}pre.sf-dump .sf-dump-index{color:#a71d5d}</style><pre class=sf-dump id=sf-dump-896378502 data-indent-pad=\" \"><span class=sf-dump-note>array:3</span> [<samp> <span class=sf-dump-index>0</span> => <span class=sf-dump-note>array:2</span> [<samp> \"<span class=sf-dump-key>product_id</span>\" => \"<span class=sf-dump-str>3</span>\" \"<span class=sf-dump-key>quantity</span>\" => <span class=sf-dump-num>2</span> </samp>] <span class=sf-dump-index>1</span> => <span class=sf-dump-note>array:2</span> [<samp> \"<span class=sf-dump-key>product_id</span>\" => \"<span class=sf-dump-str>6</span>\" \"<span class=sf-dump-key>quantity</span>\" => <span class=sf-dump-num>2</span> </samp>] <span class=sf-dump-index>2</span> => <span class=sf-dump-note>array:2</span> [<samp> \"<span class=sf-dump-key>product_id</span>\" => \"<span class=sf-dump-str>5</span>\" \"<span class=sf-dump-key>quantity</span>\" => <span class=sf-dump-num>4</span> </samp>] </samp>] </pre><script>Sfdump(\"sf-dump-896378502\")</script>"]}]}],[{"group":"doc","deltas":[{"start":{"row":0,"column":0},"end":{"row":0,"column":5020},"action":"remove","lines":["<script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^${}()|\\[\\]\\/\\\\])/g, idRx = /\\bsf-dump-\\d+-ref[012]\\w+\\b/; doc.documentElement.firstChild.appendChild(refStyle); function toggle(a) { var s = a.nextSibling || {}; if ('sf-dump-compact' == s.className) { a.lastChild.innerHTML = '&#9660;'; s.className = 'sf-dump-expanded'; } else if ('sf-dump-expanded' == s.className) { a.lastChild.innerHTML = '&#9654;'; s.className = 'sf-dump-compact'; } else { return false; } return true; }; return function (root) { root = doc.getElementById(root); function a(e, f) { root.addEventListener(e, function (e) { if ('A' == e.target.tagName) { f(e.target, e); } else if ('A' == e.target.parentNode.tagName) { f(e.target.parentNode, e); } }); }; root.addEventListener('mouseover', function (e) { if ('' != refStyle.innerHTML) { refStyle.innerHTML = ''; } }); a('mouseover', function (a) { if (a = idRx.exec(a.className)) { refStyle.innerHTML = 'pre.sf-dump .'+a[0]+'{background-color: #B729D9; color: #FFF !important; border-radius: 2px}'; } }); a('click', function (a, e) { if (/\\bsf-dump-toggle\\b/.test(a.className)) { e.preventDefault(); if (!toggle(a)) { var r = doc.getElementById(a.getAttribute('href').substr(1)), s = r.previousSibling, f = r.parentNode, t = a.parentNode; t.replaceChild(r, a); f.replaceChild(a, s); t.insertBefore(s, r); f = f.firstChild.nodeValue.match(indentRx); t = t.firstChild.nodeValue.match(indentRx); if (f && t && f[0] !== t[0]) { r.innerHTML = r.innerHTML.replace(new RegExp('^'+f[0].replace(rxEsc, '\\\\$1'), 'mg'), t[0]); } if ('sf-dump-compact' == r.className) { toggle(s); } } } }); var indentRx = new RegExp('^('+(root.getAttribute('data-indent-pad') || ' ').replace(rxEsc, '\\\\$1')+')+', 'm'), elt = root.getElementsByTagName('A'), len = elt.length, i = 0, t = []; while (i < len) t.push(elt[i++]); elt = root.getElementsByTagName('SAMP'); len = elt.length; i = 0; while (i < len) t.push(elt[i++]); root = t; len = t.length; i = t = 0; while (i < len) { elt = root[i]; if (\"SAMP\" == elt.tagName) { elt.className = \"sf-dump-expanded\"; a = elt.previousSibling || {}; if ('A' != a.tagName) { a = doc.createElement('A'); a.className = 'sf-dump-ref'; elt.parentNode.insertBefore(a, elt); } else { a.innerHTML += ' '; } a.innerHTML += '<span>&#9660;</span>'; a.className += ' sf-dump-toggle'; if ('sf-dump' != elt.parentNode.className) { toggle(a); } } else if (\"sf-dump-ref\" == elt.className && (a = elt.getAttribute('href'))) { a = a.substr(1); elt.className += ' '+a; if (/[\\[{]$/.test(elt.previousSibling.nodeValue)) { a = a != elt.nextSibling.id && doc.getElementById(a); try { t = a.nextSibling; elt.appendChild(a); t.parentNode.insertBefore(a, t); if (/^[@#]/.test(elt.innerHTML)) { elt.innerHTML += ' <span>&#9654;</span>'; } else { elt.innerHTML = '<span>&#9654;</span>'; elt.className = 'sf-dump-ref'; } elt.className += ' sf-dump-toggle'; } catch (e) { if ('&' == elt.innerHTML.charAt(0)) { elt.innerHTML = '&#8230;'; elt.className = 'sf-dump-ref'; } } } } ++i; } }; })(document); </script> <style> pre.sf-dump { display: block; white-space: pre; padding: 5px; } pre.sf-dump span { display: inline; } pre.sf-dump .sf-dump-compact { display: none; } pre.sf-dump abbr { text-decoration: none; border: none; cursor: help; } pre.sf-dump a { text-decoration: none; cursor: pointer; border: 0; outline: none; }pre.sf-dump{background-color:#fff; color:#222; line-height:1.2em; font-weight:normal; font:12px Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:100000}pre.sf-dump .sf-dump-num{color:#a71d5d}pre.sf-dump .sf-dump-const{color:#795da3}pre.sf-dump .sf-dump-str{color:#df5000}pre.sf-dump .sf-dump-cchr{color:#222}pre.sf-dump .sf-dump-note{color:#a71d5d}pre.sf-dump .sf-dump-ref{color:#a0a0a0}pre.sf-dump .sf-dump-public{color:#795da3}pre.sf-dump .sf-dump-protected{color:#795da3}pre.sf-dump .sf-dump-private{color:#795da3}pre.sf-dump .sf-dump-meta{color:#b729d9}pre.sf-dump .sf-dump-key{color:#df5000}pre.sf-dump .sf-dump-index{color:#a71d5d}</style><pre class=sf-dump id=sf-dump-896378502 data-indent-pad=\" \"><span class=sf-dump-note>array:3</span> [<samp> <span class=sf-dump-index>0</span> => <span class=sf-dump-note>array:2</span> [<samp> \"<span class=sf-dump-key>product_id</span>\" => \"<span class=sf-dump-str>3</span>\" \"<span class=sf-dump-key>quantity</span>\" => <span class=sf-dump-num>2</span> </samp>] <span class=sf-dump-index>1</span> => <span class=sf-dump-note>array:2</span> [<samp> \"<span class=sf-dump-key>product_id</span>\" => \"<span class=sf-dump-str>6</span>\" \"<span class=sf-dump-key>quantity</span>\" => <span class=sf-dump-num>2</span> </samp>] <span class=sf-dump-index>2</span> => <span class=sf-dump-note>array:2</span> [<samp> \"<span class=sf-dump-key>product_id</span>\" => \"<span class=sf-dump-str>5</span>\" \"<span class=sf-dump-key>quantity</span>\" => <span class=sf-dump-num>4</span> </samp>] </samp>] </pre><script>Sfdump(\"sf-dump-896378502\")</script>"]}]}]]},"timestamp":1430832345000}