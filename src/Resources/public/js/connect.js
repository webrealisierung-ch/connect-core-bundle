function allowDrop(ev) {
    ev.preventDefault();
}



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
            var droppedElement = document.getElementById(data);
            var todoId=this.getElementId(droppedElement,'todo');

            if(ev.target.className == "status_board") {
                statusBoard=ev.target;
                ev.target.appendChild(document.getElementById(data));
            } else {
                statusBoard=ev.target.closest(".status_board");
                ev.target.closest(".status_board").appendChild(document.getElementById(data));
            }
            statusId=this.getElementId(statusBoard,'statusBoard');
            console.log(window.location);
            this.changeStatus(todoId,statusId);
        },
        allowDrop: function(ev) {
            ev.preventDefault();
        },
        changeStatus: function (todoId,statusId) {
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.open("GET", window.location.href+"&status_id="+statusId+"&todo_id="+todoId+'REQUEST_TOKEN='+Contao.request_token, true);
            xhttp.send();
        },
        getElementId: function (element,searchPattern) {
            elementId=element.id.replace(searchPattern,'');
            return elementId;
        }
    }
};