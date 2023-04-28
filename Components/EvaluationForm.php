<?php
    
    class EvaluationForm{
        function evaluationCard($formID,$roomID){
            echo "<div class='card'>
            <div class='card-body'>
                <b>Materials or Parts</b>
                <div class='row'>
                    <div class='col-8'><p>Are there materials or parts that are not used daily or currently in use present?</p></div>
                    <div class='col-2'>
                        <select name='' id='' class='form-select' onchange=getFormID(this,'{$formID}');>
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