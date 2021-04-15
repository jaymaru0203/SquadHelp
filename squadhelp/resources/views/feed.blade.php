@extends('Master.master')

@section('title','Feed')

@section('header')

<style type="text/css">
  h2.typeQ{
    position: absolute;
    font-size: 16px; 
    padding: 5px 10px;
    top: -20px;
    right: -10px;
    background-color: #ff2316;
    color: white;
    border-radius: 5px;
}

.selectdiv select{
  width: 100%;
  min-width:140px;
  height: 48px;
  background-color: #ffffff;
  font-size: 14px;
  font-weight: 500;
  color: #434343;
  border-radius: 5px;
  border: 1px solid #d6d6d6;
  padding: 6px 12px; 

}

.selectdiv{
  position: relative;
}

.selectdiv:after {
    content: '\f107';
    font: normal normal normal 15px/1 FontAwesome;
    color: #737b83;
    right: 7px;
    top: 3px;
    height: 34px;
    padding: 15px 0px 0px 8px;
    position: absolute;
    pointer-events: none;
}

.selectdiv select{
 -webkit-appearance: none;
}


@media screen and (max-width: 650px) {
  h2.typeQ{
    position: absolute;
    font-size: 14px; 
    padding: 5px 10px;
    top: -25px;
    right: -15px;
    background-color: #ff2316;
    color: white;
    border-radius: 5px;
}


.selectdiv select{

 margin: 5px 0px;
}


.flex-container {
  display: flex;
  flex-wrap: wrap;
}
}

</style>
@endsection

@section('content')

    <div class="right-container">
      
      <!-- ask question container -->
      <div class="post-container filter" >
        <h1 class="filter-heading">Filter Results</h1>
        <form action="filter" method="GET" class="flex-container">
        <!--   <div class="filter-options">
            <input type="radio" name="filterData" id="placements" class="checkbox" value="Placements">
            <label for="placements">Placements</label>
          </div>
          <div class="filter-options">
            <input type="radio" name="filterData" id="cocurricular" class="checkbox" value="Co-curricular">
            <label for="cocurricular">Co-Curricular</label>
          </div>
          <div class="filter-options">
            <input type="radio" name="filterData" id="masters" class="checkbox" value="Masters">
            <label for="masters">Masters</label>
          </div>
          <div class="filter-options">
            <input type="radio" name="filterData" id="hackathons" class="checkbox" value="Hackathons">
            <label for="hackathons">Hackathons</label>
          </div>
          <div class="filter-options">
            <input type="radio" name="filterData" id="internships" class="checkbox" value="Internships">
            <label for="internships">Internships</label>
          </div>
          <div class="filter-options">
            <input type="radio" name="filterData" id="others" class="checkbox" value="Others">
            <label for="others">Others</label>
          </div>
          <div class="filter-options">
            <input type="radio" name="filterData" id="all" class="checkbox" value="all">
            <label for="all">All</label>
          </div> -->
         <div class="container-fluid">
          <div class="row">
           <div class="col-lg-3 col-md-3">
           <div class="selectdiv">  
                  <select name="filtercategory" id="filtercategory">
                    <option value="All">Select Category</option>
                    <option value="Placements">Placements</option>
                    <option value="Internships">Internships</option>
                    <option value="Hackathons">Hackathons</option>
                    <option value="Co-curricular">Co-curricular</option>
                    <option value="Others">Others</option>
                    <option value="All">All</option>

            </select>
          </div>
          </div>
          <div class="col-lg-3 col-md-3">
          <div class="selectdiv">  
                  <select name="filterbranch" id="filterbranch">
                    <option value="All">Select Branch</option>
                    <option value="COMPS">COMPS</option>
                    <option value="ETRX">ETRX</option>
                    <option value="EXTC">EXTC</option>
                    <option value="IT">IT</option>
                    <option value="MECH">MECH</option>
                    <option value="All">All</option>
                  </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="selectdiv">  
                  <select name="filteryear" id="filteryear">
                    <option value="All">Select Year </option>
                    <option value="FY">FY</option>
                    <option value="SY">SY</option>
                    <option value="TY">TY</option>
                    <option value="LY">LY</option>
                    <option value="All">All</option>
                  </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-3">
            <div class="filter-options">
              <button type="submit" class="filter-btn">Filter</button>
            </div>
          </div>
        </div>
        </div> 
        </form>
      </div>
      
      <!-- posted questions -->
      @foreach($question as $q)
      <div class="post-container posted mb-3">
    
      <div class="userdetails-container">
        <div class="user-image">


         <?php 
            $conn = new mysqli('localhost', 'root' , '' , 'laravel');
            $email = session()->get('user');
            $qemail = $q->user_email;

            // $sql = "SELECT DISTINCT sender FROM chat_messages WHERE sender!='$email' AND chatRoomID='$id1'";
            $sql = "SELECT * FROM nusers WHERE user_email='$qemail'";
            $res = $conn->query($sql);
            if($res->num_rows > 0){
            while($r=$res->fetch_assoc()){ ?>

           <img src="{{asset('storage/uploads')}}/<?php echo $r['image']; ?>" alt="">

         
          </div>

        <div class="user-details">
          <h1><?php echo $r['name']; ?></h1>
            <?php }} ?>
          <h2>Question For : {{ $q->year }} | {{ $q->branch }}</h2>
        </div>

        <div class="post-date">
          <h2 class="typeQ">{{ $q->type_of_question }}</h2>
          <p>{{ $q->created_at }}</p>
        </div>
          
      </div>

      <!-- question -->
      <div class="row question-info">
        
        <div class="col-11 question">
          <p>{{ $q->question_content }}</p>
        </div>

      </div>


      <div class="question-container">
        @if(($user_details->year == $q->year || $q->year == "All") && ($user_details->branch == $q->branch || $q->branch == "All"))
        <form action="postanswer" method="GET">
          <input type="hidden" name="question_id" value="{{$q->question_id}}">
          
          <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input type="text" class="form-control" name="answer" placeholder="Write an Answer.." aria-label="Write an Answer.." aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-location-arrow" style="font-size:20px;vertical-align: middle;"></i></button>
          </div>
        </form>
        <div style="text-align: center;"><a href="allanswers/{{$q->question_id}}">Show All Answers</a></div>

        @else
        <form >
          <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input type="text" class="form-control" name="answer" placeholder="You aren't eligible to answer this question..." aria-label="Write an Answer.." aria-describedby="button-addon2" disabled>
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2" disabled><i class="fa fa-location-arrow" style="font-size:20px;vertical-align: middle;"></i></button>
          </div>
        </form>
        <div style="text-align: center;"><a href="allanswers/{{$q->question_id}}">Show All Answers</a></div>
        
        @endif
      </div>
      </div>

      @endforeach
 

    </div><br><br><br><br>

@endsection