function send_answer() {
    
    answer = []
    
    const functions = [];
    
    var fio = document.getElementById("userFIO").value;
    var category = document.getElementById("category").value;
    var comment = document.getElementById("comment").value;
   
    console.log(comment)
    
    questions = $('.questions')
    const questionsCount = questions.children().length
    for (let questionIndex = 0; questionIndex < questionsCount; questionIndex++ ) {
        
        functionId = $('.function')[questionIndex].attributes.name.value
        
        importance  = document.getElementById("importance-"+functionId).value;
        presence  = document.getElementById("presence-"+functionId).value;
        absence  = document.getElementById("absence-"+functionId).value;

        currentFunction = {
            "id":functionId,
            "importance":importance,
            "presence": presence,
            "absence": absence,
        }
        
        functions.push(currentFunction)
    }
    
    
    answer.push({'fio':fio, 'category':category, "functions":functions, "comment": comment})

    $.ajax({
        async: false,
        type: "POST",
        data: {
            action: 'send_answer',
            answer: answer[0]}
            
    })
}


