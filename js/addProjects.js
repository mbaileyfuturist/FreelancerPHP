function addProjects(){
    //Grab existing form.
    var initialInput = document.getElementById('initial-input');

    //Elements for project name.
    var div1 = document.createElement('div');
    div1.className = 'form-group';
    var label1 = document.createElement('label');
    var text1 = document.createTextNode('Project Name');
    var input1 = document.createElement('input');
    input1.className = 'form-control';
    input1.type = 'text';
    input1.placeholder = 'Project Name';

    //Add text to label1
    label1.appendChild(text1);

    //Elements for degree type.
    var div2 = document.createElement('div');
    div2.className = 'form-group';
    var label2 = document.createElement('label');
    label2.className = 'mt-3'
    var text2 = document.createTextNode('Project Description');
    var textarea = document.createElement('textarea');
    textarea.className = 'form-control';
    textarea.type = 'text';
    textarea.placeholder = 'Project Description...';
    textarea.setAttribute('rows', 7);

    //Add text to label2
    label2.appendChild(text2);

    //Append Elements to extend form.
    initialInput.appendChild(div1);
    div1.appendChild(label1);   
    div1.appendChild(input1);
    div1.appendChild(div2);
    div2.appendChild(label2);
    div2.appendChild(textarea);
}