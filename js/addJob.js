function addJobs(){

    //Grab existing form.
    var initialInput = document.getElementById('initial-input');

    //Create form for education.
    var form = document.createElement('form');
    form.className = "mt-5";

    //Elements for job name.
    var div1 = document.createElement('div');
    div1.className = 'form-group';
    var label1 = document.createElement('label');
    var text1 = document.createTextNode('Job Name');
    var input1 = document.createElement('input');
    input1.className = 'form-control';
    input1.type = 'text';
    input1.placeholder = 'Job Name';

    //Add text to label1
    label1.appendChild(text1);

    //Elements for job description.
    var div2 = document.createElement('div');
    div2.className = 'form-group';
    var label2 = document.createElement('label');
    label2.className = 'mt-3'
    var text2 = document.createTextNode('Job Description');
    var input2 = document.createElement('textarea');
    input2.className = 'form-control';
    input2.type = 'text';
    input2.placeholder = 'Job Description';
    input2.setAttribute("rows", "7");

    //Add text to label2
    label2.appendChild(text2);

    //Append Elements to create new form.
    initialInput.appendChild(div1);
    div1.appendChild(label1);   
    div1.appendChild(input1);
    div1.appendChild(div2);
    div2.appendChild(label2);
    div2.appendChild(input2);
    
}