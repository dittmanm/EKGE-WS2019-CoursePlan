/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
http://localhost:3030/akwi-latest-graph

    function sendQuery(){
        /* main procedure of this object is called from outside */
        var sparqlQuery = this.createQuery(); //creates the specific query
        console.log(sparqlQuery);
        this.query(sparqlQuery, "sparql-query"); //submit sparql Querry
        window.alert("Sparql queries are sended to Fuseki.");
    }

    function query(body, content_type="sparql-query", url="http://localhost:3030/Test_2_Unip") {
        const Http = new XMLHttpRequest();
        Http.open("POST", url, false);
        Http.setRequestHeader("Content-type", ("application/"+content_type));
        try{
            Http.send(body);
        }
        catch(e){
            window.alert("Network Error. Check Internet connection.")
        }

        Http.onreadystatechange = function() { //Error stops the script
            if (Http.readyState == 4  ) { // 4 means that request is done
                if(Http.status!=200){
                    window.alert("And Error occured with the request. Check internet connection.");
                    throw new Error("Error status code != 200");
                }
            }
        }

        if(!Http.responseText){
            //sparql-query answer has no body
            return;
        }
        //sparql-update has a body
        return JSON.parse(Http.responseText);
    }