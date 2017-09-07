function allowDrop(ev) {
    ev.preventDefault();
}

console.log(window);


Connect = {
    Todo: {
        toggleClass: function(event, el) {
            r = [];
            n = el.parentNode.childNodes;
            for (i = 0; i < n.length; i++) {
                if (n[i].nodeType == 1) {
                    r.push(n[i]);
                }
            }
            for (i = 0; i < r.length; i++) {
                if (r[i].className == "description") {
                    r[i].className = "description open";
                }
                else if (r[i].className == "description open") {
                    r[i].className = "description";
                }
            }

        },
        drag: function(event) {
            event.dataTransfer.setData("text", event.target.id);
        },
        drop: function(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            console.log(ev);
            ev.target.appendChild(document.getElementById(data));
        },
        allowDrop: function(ev) {
            ev.preventDefault();
        }
    }
};