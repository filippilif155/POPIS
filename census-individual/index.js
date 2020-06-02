let next = document.querySelector(".tick");
let prev = document.querySelector(".back");

next.addEventListener("click", nextQuestion);
let count=0;

function nextQuestion(e){
    count++;
    e.preventDefault();
    if (count<6){
        let nextQ = document.querySelector(`.f${count+1}`);
        let curQ = document.querySelector(`.f${count}`);
        curQ.style.display = "none";
        nextQ.style.display = "block";
    }
    if (count === 6){
        openModalWindow();
        count--;
    }

    function openModalWindow(){
        let q1 =  "Vaša nacionalna pripadnost: " + document.querySelector(".select-nacija").value;
        let q2 = "Maternji jezik: " + document.querySelector(".select-jezik").value;
        let q3 = "Vjeroispovijest: " + document.querySelector(".vjera").value;
        let q4, q5, q6;
        for (let i=0;i<2;i++){
            if (document.querySelectorAll('input[name="posao"]')[i].checked){
                q4 = "Zaposlenost: " + document.querySelectorAll('input[name="posao"]')[i].value;
                console.log("da");
            }
            if (document.querySelectorAll('input[name="gender"]')[i].checked){
                q5 = "Pol: " + document.querySelectorAll('input[name="gender"]')[i].value;
            }
            if (document.querySelectorAll('input[name="brak"]')[i].checked){
                q6 = "Brak: " + document.querySelectorAll('input[name="brak"]')[i].value;
            }
        }
        
        

        let arrHelp = [q1, q2, q3, q4, q5, q6];
        
        let modalW = document.createElement("div");
        let table = document.createElement("table");
        
        
        
        
        for(let i=0;i<6;i++){
            
            let row = document.createElement("tr");
            let field = document.createElement("td");
            field.innerText = arrHelp[i];
            row.appendChild(field);
            table.appendChild(row);
            
        }


        modalW.className = "modal-window";
        modalW.appendChild(table);


        let x = document.createElement("button");
        x.innerText = "X";
        x.className = "x";


        
        modalW.appendChild(x);
        document.querySelector(".submit").style.display = "inline-block";
        let mask = document.createElement("div");
        mask.className = "mask";
        x.addEventListener("click", (event) => {
            mask.style.display = "none";
            main.removeChild(modalW);
            document.querySelector(".submit").style.display = "none";
          });
 
        let main = document.querySelector(".main");
        main.appendChild(mask);
        main.appendChild(modalW);

        
    }
    
}
prev.addEventListener("click", prevQuestion);

    function prevQuestion(e){
        if (count>=1){
            e.preventDefault();
            count--;
            console.log(count);
            
            let curQ = document.querySelector(`.f${count+2}`);
            if(curQ !== null){
                
                curQ.style.display = "none";
            }
            else{
                count--;
                let curQ = document.querySelector(`.f${count+2}`);
                curQ.style.display = "none";

            }
            let prevQ = document.querySelector(`.f${count+1}`);
            prevQ.style.display = "block";
        }
        else{
            console.log("!!!")
        }
}