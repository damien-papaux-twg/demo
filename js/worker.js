/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*var ele = document.getElementById('fileUpload');
 if (ele) {
 ele.addEventListener('change', fileTraitement(), false);
 }*/

function fileTreatment() {
    var files = $('#file-6')[0].files;
    var indiArray = [];

    for (var i = 0; i < files.length; i++) {
        (function(file) {
            var individual = {};
            individual.headline = file.name;
            var reader = new FileReader();

            reader.onload = function(e) {
                // get file content
                individual.bio = e.target.result;
                indiArray.push(individual);
            };

            reader.onloadend = function(e) {

            };
            reader.readAsText(file);
            if(files.length - i === 1) {
                console.log(i);
            }
        })(files[i]);
    }
    var jobTitle = $('#jobTitle').val();
    var jobDescription = $('#jobDescription').val();
    var job = {};
    job.title = jobTitle;
    job.description = jobDescription;
    console.log(job);
}