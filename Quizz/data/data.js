
$(function(){
    
       
    //----------------------------------------------------
    let nb=4;
    const keyStorage="ODC::nbElt";
    let page=1;
    let coul;
    let clone;
    let type;
    let objEnCours=null;
    // ----------------------------------------------------
    const getDonneesApi = (n) =>{
        $.ajax({
            method: "GET",
            url: `https://randomuser.me/api/?results=${n}`
        })
        .done(data => {
            const u = objUser(data.results);
            const j ={...u};
            setDonneesApi(j);
        })
    }
    const getDonneesUser = (id=0) =>{
        $.ajax({
            method:"GET",
            url: `Quizz/pages/admin/listeUsers/getUsers.php?id=${id}&nb_elt=${nb}&page=${page}`
        })
        .done(data => {
            const {value,type,nb_elt}=JSON.parse(data);
            let is_get_api=1;            
            page++;
            if(nb_elt>0){
                if(type==0){
                    ajoutLigne(value);
                    if(nb_elt == nb){
                        is_get_api=0;
                    }
                }else{
                    is_get_api=0;
                    getInfoUser(value[0]);
                }   
            }
            if(is_get_api ==1){
                const n =nb - nb_elt;
                alert(" - Pas assez de données\n Je vais sur randomuser")
                getDonneesApi(n);
            }
            // console.log(JSON.parse(data));
        })
    }
    const setDonneesApi = (usr) =>{
        $.ajax({
            method:"POST",
            url: "Quizz/pages/admin/listeUsers/setUsers.php",
            data:usr
        })
        .done(data =>{
            const value = JSON.parse(data);
            ajoutLigne(value);
            console.log(value);
        })
    }
    const upDonneesBd = (data) =>{
        $.ajax({
            method:"POST",
            url: "Quizz/pages/admin/listeUsers/setUpdate.php",
            data:data
        })
        .done(data =>{
            console.log(data);
        })
    }
    const upDonneesImg = (data) =>{
        $.ajax({
            method:"POST",
            url: "Quizz/pages/admin/listeUsers/setUpdate.php",
            data:data,
            contentType:false,
            processData:false
        })
        .done(data =>{
            console.log(data);
            const d= JSON.parse(data);
            const img=`<img class="img-thumbnail" src="${d.image}" alt="thumbnail"/>`;
            objEnCours.html(img);
        })
    }
    // const getInfoUser = (info) =>{
    //     console.log(info);
    //     $.ajax({
    //         method:"GET",
    //         url: "Quizz/pages/admin/listeUsers/getInfo.php",
    //         data:info
    //     })
    //     .done(data =>{
    //         console.log(data);
    //         $("#info").html(data);
    //     })
    // }
// -----------------------------------------------------------
    $("#bd_users")
    .on("click","tr",function(){
       // alert($(this).html())
       coul=$("body").css("background-color");
       $(this).css("background-color","orange");
       $("#bd_users tr").not(this).css("background-color",coul);
    })
    .on('dblclick',"td",function(){
        $(this).parents().css("background-color",coul);
        const id =$(this).attr("id");
        const tab = id.split("_");
        objEnCours=$(this);
        //console.log($(this).children().clone());
        type=tab[0];
        clone=type==="i"?$(this).children().clone():$(this).text();
       // alert(clone)
        if((type==='t') || (type ==='i')){
            const input=getInput(tab,clone);
            $(this).html(input);
            $(this).children().focus();
        }
       
    })
    .on("focusout","td",function(e){
        
        const {id,value} = e.target;
        const tab=id.split("_");
        if(type==='t') {
            $(this).html(value); 
            const data={
                "table":"users",
                "champ":tab[0],
                "id":tab[1],
                "val":value
            }
            upDonneesBd(data);
        }else if(type==='i'){
            if(value.trim() != ""){
               const file_data =e.target.files[0];
               console.log(file_data);
               let data = new FormData();
               data.append('file',file_data);
               data.append('table',"users");
               data.append('id',tab[1]);
               upDonneesImg(data);
            }            
        }
        console.log(e);
    })
    .on('keyup','td',function(e){
       if(e.keyCode ==13){// Touche Entré
        $(this).html(e.target.value);
       }else if(e.keyCode ==27){// Touche Echap
        $(this).html(clone);
       }
    });
    $("#nb_elt").on('change',function(){
        setStorage($(this).val());        
    });
    $("#bd_users").on("click",".btn",function(){
        const tab = $(this).parents().attr("id").split("_");
        const id=tab[2];
        const type=tab[0];
        if(type =='s'){
            if(confirm("Voulez vous supprimer !!")){
                const data={
                    "table":"users",
                    "champ":"status",
                    "id":id,
                    "val":0
                }
                $(this).parents("tr").hide()
               upDonneesBd(data);
            }
        }else if(type =='f'){
            getDonneesUser(id);
        }
    }) 
   
    // ----------------------------------------------------
    const objUser=(datas) => {
        let usrs=[];
        for(const data of datas){
            const {firstname,name,profil,image,score}=JSON.parse(data);
            const usr={
                Prenom:firstname,
                nom:name,
                profil:profil,
                image:image,
                score:score
            };
            usrs=[...usrs,usr];
        }
        return usrs;
    }
    
    function ajoutLigne(value){
        let line;
        for(const v of value){
            line=`
                <tr id ="tr_${v.id}">
                    <td id="_id_${v.id}">${v.idusers}</td>
                    <td id="i_img_${v.id}"><img class="img-thumbnail" src="${v.image}" alt="thumbnail"/></td>
                    <td id="t_profil_${v.id}">${v.profil}</td>
                    <td id="t_prenom_${v.id}">${v.firstname}</td>
                    <td id="t_nom_${v.id}">${v.name}</td>
                    <td id="t_score_${v.id}">${v.score}</td>
                    <td id="s_supp_${v.id}"><button class="btn btn-danger"><span class="fa fa-archive"></span></button></td>
                    <td id="f_info_${v.id}"><button class="btn btn-info"><span class="fa fa-binoculars"></span></button></td>                   
                </tr>
            `;
            $("#bd_users").append(line);
            // console.log($("#bd_users").append(line));
            
        }
    }

    function getInput(tab,txt){
        const tp={
            "t":"text",
            "i":"file"
        };
        type=tab[0];
        const v= type=="i"?' accept="image/png, image/jpeg"':` value="${txt}"`;
        const input = `<input type ="${tp[type]}" id="${tab[1]}_${tab[2]}" ${v} />`;
        return input;
    }
    function getStorage(){
        return localStorage.getItem(keyStorage);
    }
    function setStorage(value){
        return localStorage.setItem(keyStorage,value);
    }
    function isScrole(){
        $(window).scroll(function(){
           if(( $(document).height() -  $(this).height() -  $(this).scrollTop()) <=5){
            getDonneesUser();

           }
        })
    }

    if(!getStorage()){
        setStorage(nb);
    }else{
        nb=getStorage();
    }
    $("#nb_elt").attr("value",nb);
    $("#suiv").on("click",function(){
        getDonneesUser();
    })
    getDonneesUser();
    isScrole();
    // getDonneesApi(nb);
})
