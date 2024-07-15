import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";

const test = document.querySelectorAll(".test");
const urlShow = "http://127.0.0.1:8000/admin/flats/"
let curValue = "";

test.forEach((curItem)=>{
    
    curValue = curItem.firstElementChild.value;
    console.log(curValue);
    
    curItem.addEventListener("click", ()=>{

        document.location.href = `${urlShow}${curValue}`
    } )
    console.log(curItem);
})
