<?php
session_start();

if (file_exists('includes/database.php')) { include_once('includes/database.php'); }
if (file_exists('../includes/database.php')) { include_once('../includes/database.php'); }
$studentid = $_GET['studentid'];
$companyid = $_GET['companyid'];
?>


<style>
        .rating-container {
            text-align: center;
            margin-top: 20px;
        }

        h3 {
            color: #a22a2a;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .rating {
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: row-reverse;
            font-size: 60px;
            color: #666;
        }

        .rating:not(:checked) > input {
            position: absolute;
            appearance: none;
        }

        .rating:not(:checked) > label {
            cursor: pointer;
        }

        .rating:not(:checked) > label:before {
            content: '★';
        }

        .rating > input:checked + label:hover,
        .rating > input:checked + label:hover ~ label,
        .rating > input:checked ~ label:hover,
        .rating > input:checked ~ label:hover ~ label,
        .rating > label:hover ~ input:checked ~ label {
            color: #e58e09;
        }

        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: #ff9e0b;
        }

        .rating > input:checked ~ label {
            color: #ffa723;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            background-color: #a22a2a;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }


    .info-group {
        margin-top: 20px;
    }

    .info-group label {
        display: flex;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .info-group p {
        margin: 0;
        font-style: italic;
    }
    .info-group h4, .info-group p {
        margin: 0;
    }

.info-group {
    margin-top: 20px;
}

.info-content {
    display: flex;
}

.info-content h4,
.info-content p {
    margin: 0px;
}

.scroll-container{
            width: 100%;
            max-height: 440px;
            overflow-y: auto;
}

    </style>
<div class="scroll-container">
	<div class="rating-container">
		<form method="post" id="myForm" action="">
			<h3>Please rate your experience with this internship establishment!</h3>
			<div class="rating">
				<input value="5" name="rating" id="5" type="radio">
				<label title="Excellent" for="5"></label>
				<input value="4" name="rating" id="4" type="radio">
				<label title="Very Good" for="4"></label>
				<input value="3" name="rating" id="3" type="radio">
				<label title="Good" for="3"></label>
				<input value="2" name="rating" id="2" type="radio">
				<label title="Fair" for="2"></label>
				<input value="1" name="rating" id="1" type="radio">
				<label title="Poor" for="1"></label>
			</div>

			<textarea name="description" id="description" placeholder="Type your feedback here..."></textarea>
			
			<?
			$is_end = GetValue('SELECT is_end FROM tblstudent WHERE companyid='.$companyid.' AND studentid='.$_SESSION['studentid']);
			if($is_end){
				echo'<a href="javascript:void(0);" onclick="save_feedback('.$companyid.')">Submit Feedback</a>';
			} else {
				echo'';
			}
			
			
			?>
			
		   <? 
				$q = 'SELECT ratingid, description, studentid,
						companyid,datetime_rate, rating from tblrating WHERE companyid='.$companyid;
						//echo $q;
				$rs = mysqli_query($db_connection,$q);
				while($rw = mysqli_fetch_array($rs)){
					echo'<div align="left" class="info-group">
							<h4>'.StudentName($rw['studentid']).'</h4>
							<p>'.$rw['description'].'</p>
						</div>';
				}
				?>	
		</form> 
	</div>
</div>