<?php
    
    class EvaluationForm{
        function evaluationCard($formID,$roomID,$title,$desc){
            echo "<div class='card mt-2'>
            <div class='card-body'>
                <b>{$title} <small id='{$formID}_evaluated' style='display: none;padding: 3px; border-radius: 20px; background-color: green; color:#fff; font-size: 0.7rem;'>Evaluated</small></b>
                <div class='row'>
                    <div class='col-8'><p>{$desc}</p></div>
                    <div class='col-2'>
                        <select name='' id='{$formID}selection' class='form-select' onchange=getFormID(this,'{$formID}');>
                            <option value=''>- Select -</option>
                            <option value='Complying'>Complying</option>
                            <option value='NonComplying'>Non-complying</option>
                            <option value='NA'>N/A</option>
                        </select>
                    </div>
                    <input type='hidden' id='{$formID}_saveFormIdSelected'>
                    <div class='col text-center'>
                        <a type='button' data-bs-toggle='modal' data-bs-target='#ComplyModal' id='{$formID}_AddComply' style='display:none;'><i class='fa-solid fa-circle-plus' style='font-size: 2rem;'></i></a>
                        <a type='button' id='{$formID}_Save' style='display:none;' onclick=saveItem('{$formID}','$roomID')><i class='fa-solid fa-save text-success' style='font-size: 2rem;'></i></a>
                    </div>
                </div>
                
            </div>
        </div>";
        }
    }

    



?>