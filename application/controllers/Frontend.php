<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Frontend extends CI_Controller {
	public function __construct(){

		parent::__construct();
		$this->load->model('frontend_model');
		$this->load->model('images');
		$this->load->database();
	}
	public function index()
	{
		$data = array(
			'title' => 'Welcome',
		);
		$data['testimonials']=$this->frontend_model->get_testimonials(array(),false);

		$this->load->view('home_page', $data);
	}
	public function home()
	{
		$data = array(
			'title' => 'Welcome',
		);
        $data['testimonials']=$this->frontend_model->get_testimonials(array(),false);
        //print_r($data['testimonials']); exit();
		$this->load->view('home_page', $data);
	}
	public function grades(){
		$data['title']='Grades';
		$this->load->view('frontend/grade_page',$data);
	}
	public function topic($subject='',$grade=''){
        $user_id = get_current_user_id();
		if(loginCheck() && get_returnfield('user','id',get_parent(get_current_user_id()),'membership_plan')=='1') {
			if ( $user_id ) {
				$this->load->model( 'user_model' );
				$data['completed_topics'] = $this->user_model->get_log_in_user_topic( $user_id );
			}
		}
	    if($grade!='' && $subject!='') {
            $data['banner_title'] = ucfirst($subject);
            $data['title'] = ucfirst(get_returnfield('grade', 'slug', $grade, 'name') . ' ' . ucfirst($subject));
            $grade_id = get_id_by_slug('id', $grade, 'grade');
            $subject_id = get_id_by_slug('id', $subject, 'subject');
            $data['grade'] = get_returnfield('grade', 'id', $grade_id, 'slug');
            $data['subject'] = get_returnfield('subject', 'id', $subject_id, 'slug');
            //$data['topic']=get_returnfield('topics','topic_id',$topic_id,'slug');
            $data['topics'] = get_topic_by(0, $subject_id);


            //print_r($data['topics']); exit();
            $data['grades_lists'] = $this->frontend_model->get_grades(array(), false);
            $data['grade_content']=$this->frontend_model->get_grade_content(array('subject_id'=>$subject_id,'grade_id'=>$grade_id),true);
            //print_r( $data['topics']); exit();
            $data['grade_id'] = $grade_id;
            $data['questions'] = $this->frontend_model->get_questions(array('grade_id' => $grade_id, 'subject_id' => $subject_id), false);

            $this->load->view('frontend/topic_page', $data);
        } elseif(!empty($_POST['grade_id']) && !empty($_POST['subject_id'])){
            $data['banner_title'] = ucfirst(get_returnfield('subject','id',$_POST['subject_id'],'name'));
            $data['title'] = ucfirst(get_returnfield('grade','id',$_POST['grade_id'],'name') . ' ' . get_returnfield('subject','id',$_POST['subject_id'],'name'));
            $grade_id = $_POST['grade_id'];
            $subject_id = $_POST['subject_id'];
            $data['grade_content']=$this->frontend_model->get_grade_content(array('subject_id'=>$subject_id,'grade_id'=>$grade_id),true);
            $data['grade'] = get_returnfield('grade', 'id', $grade_id, 'slug');
            $data['subject'] = get_returnfield('subject', 'id', $subject_id, 'slug');
            //print_r($data);
            //$data['topic']=get_returnfield('topics','topic_id',$topic_id,'slug');
            $data['topics'] = get_topic_by(0, $subject_id);
            //print_r($data['topics']); exit();
            $data['grades_lists'] = $this->frontend_model->get_grades(array(), false);
            //print_r( $data['topics']); exit();
            $data['grade_id'] = $grade_id;
            $data['questions'] = $this->frontend_model->get_questions(array('grade_id' => $grade_id, 'subject_id' => $subject_id), false);
            $this->load->view('frontend/topic_page', $data);
        } else{
            $this->home();
        }
	}
    public function math($subject='math'){
	    if($subject==''){
	        $subject=$this->uri->segment(2);
        }
        //echo $subject;
        $user_id = get_current_user_id();
	    if(loginCheck() && get_returnfield('user','id',get_parent(get_current_user_id()),'membership_plan')=='1') {
		    if ( $user_id ) {
			    $this->load->model( 'user_model' );
			    $data['completed_topics'] = $this->user_model->get_log_in_user_topic( $user_id );
		    }
	    }

        $data['banner_title'] = ucfirst($subject);
        $data['title'] = ucfirst($subject);
        $subject_id= get_id_by_slug('id', $subject, 'subject');
        //echo $this->db->last_query();
        //echo $subject_id; exit();
        $data['subject'] = get_returnfield('subject', 'id', $subject_id, 'slug');
        $data['topics'] = get_topic_by(0, $subject_id);
        $data['grades_lists'] = $this->frontend_model->get_grades(array(), false);
        //print_r($data['topics']);

        $this->load->view('frontend/maths_overview_v', $data);
        ///////////////////////////////////////

    }
    public function english($subject='english'){
        if($subject==''){
            $subject=$this->uri->segment(2);
        }
        //echo $subject;
        $user_id = get_current_user_id();
	    if(loginCheck() && get_returnfield('user','id',get_parent(get_current_user_id()),'membership_plan')=='1') {
		    if ( $user_id ) {
			    $this->load->model( 'user_model' );
			    $data['completed_topics'] = $this->user_model->get_log_in_user_topic( $user_id );
		    }
	    }

        $data['banner_title'] = ucfirst($subject);
        $data['title'] = ucfirst($subject);
        $subject_id= get_id_by_slug('id', $subject, 'subject');
        //echo $this->db->last_query();
        //echo $subject_id; exit();
        $data['subject'] = get_returnfield('subject', 'id', $subject_id, 'slug');
        $data['topics'] = get_topic_by(0, $subject_id);
        $data['grades_lists'] = $this->frontend_model->get_grades(array(), false);
        //print_r($data['topics']);

        $this->load->view('frontend/english_overview_v', $data);
        ///////////////////////////////////////

    }
	public function questions($subject,$grade,$topic,$start=0){
		$data['banner_title']=ucfirst($subject);
		$data['title']=ucfirst($grade);
		$grade_id=get_id_by_slug('id',$grade,'grade');
		$subject_id=get_id_by_slug('id',$subject,'subject');
		$topic_id=get_returnfield('topics','slug',$topic,'topic_id');
		$data['subjects']=get_table_data(array('id','name'),'subject');
		$this->set_question_bank(array('grade_id'=>$grade_id,'subject_id'=>$subject_id,'topic_id'=>$topic_id));
		if(!empty($this->session->userdata('q_id_array'))){
            $where_id_in=explode(',',$this->session->userdata('q_id_array'));
        }

		$data['questions']=$this->frontend_model->get_questions_by_one(array('grade_id'=>$grade_id,'subject_id'=>$subject_id,'topic_id'=>$topic_id),false,$start,array(),$where_id_in);
		$data['start']=1;
		$data['grade_id']=$grade_id;
		$data['subject_id']=$subject_id;
		$data['topic_id']=$topic_id;
		//print_r($data); exit();
		//echo $this->db->last_query(); exit();
		$this->session->unset_userdata('score_ans');
		$this->session->unset_userdata('score_smart');
		$this->session->unset_userdata('total_qScore');
		$this->load->view('frontend/questions_page',$data);
	}
    public function set_question_bank($aa){
        $all_q=$this->frontend_model->get_questions($aa,false);
        $total_question_count=count($all_q);
        if($total_question_count>10){
            $all_q=$this->frontend_model->get_questions('',false, 10);
            $total_question_count=count($all_q);
        }
        $q_id_array='';
        $q_total_marks=0;
        foreach ($all_q as $s_q){
            //print_r($s_q); exit();
            $q_id_array .=($q_id_array!='') ? ','.$s_q->question_id : $s_q->question_id;
            $form_datas=unserialize($s_q->form_data);
            $q_total_marks=$q_total_marks+$form_datas['q_score'];
        }
        $this->session->set_userdata('total_question_count',$total_question_count);
        $this->session->set_userdata('total_question_marks',$q_total_marks);
        $this->session->set_userdata('q_id_array',$q_id_array);
    }
	public function worksheets($grade_slug='',$subject_slug='',$cat_slug='',$topic_slug=''){
        $data['title']='Worksheets';
        $where='';
        if(!empty($_GET)){
            $type=$_GET['type'];
            $id=$_GET['id'];
            if($type=='subject'){
                $data['worksheets']=$this->frontend_model->get_worksheets(array('work_subject_id'=>$id));
            } elseif($type=="grade") {
                $data['worksheets']=$this->frontend_model->get_worksheets(array('work_grade_id'=>$id));
            } elseif($type=="cat") {
                $data['worksheets']=$this->frontend_model->get_worksheets(array('work_cat_id'=>$id));
            } elseif($type=="topic") {
                $data['worksheets']=$this->frontend_model->get_worksheets(array('work_topic_id'=>$id));
            }

        } else{
            $data['worksheets']=$this->frontend_model->get_worksheets();
            $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        }


        if($grade_slug!=''){
            $grade_id=get_id_by_slug('id',$grade_slug,'work_grades');
            $where.=($where!='')?' AND work_grade_id='.$grade_id:' work_grade_id='.$grade_id;
            $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        }
        if($subject_slug!=''){
            $subject_id=get_id_by_slug('id',$subject_slug,'work_subjects');
            $where.=($where!='')?' AND work_subject_id='.$subject_id:' work_subject_id='.$subject_id;
            $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        }
        if($cat_slug!=''){
            $cat_id=get_id_by_slug('id',$cat_slug,'work_categories');
            $where.=($where!='')?' AND work_cat_id='.$cat_id:' work_cat_id='.$cat_id;
            $start_index = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        }
        if($topic_slug!=''){
            $topic_id=get_id_by_slug('id',$topic_slug,'work_topics');
            $where.=($where!='')?' AND work_topic_id='.$topic_id:' work_topic_id='.$topic_id;
            $start_index = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
        }
        if($where!=''){
            $data['worksheets']=$this->frontend_model->get_worksheets($where);
        }

        $data['work_subjects']=$this->frontend_model->get_work_subjects();
        $data['work_grades']=$this->frontend_model->get_work_grades();
        $data['work_categories']=$this->frontend_model->get_work_categories();
        $data['work_topics']=$this->frontend_model->get_work_topics();
        $data['worksheetrating']=$this->frontend_model->get_worksheet_rating();
        $this->load->view('frontend/worksheet_list_page', $data);
	}
	public function math_worksheet(){
        $data['title']='Worksheets';
        $where='';
        $subject_id=get_id_by_slug('id','math','work_subjects');
        $where.=($where!='')?' AND work_subject_id='.$subject_id:' work_subject_id='.$subject_id;
        $data['worksheets']=$this->frontend_model->get_worksheets($where);
        $data['work_subjects']=$this->frontend_model->get_work_subjects();
        $data['work_grades']=$this->frontend_model->get_work_grades();
        $data['work_categories']=$this->frontend_model->get_work_categories();
        $data['work_topics']=$this->frontend_model->get_work_topics();
        $data['worksheetrating']=$this->frontend_model->get_worksheet_rating();
        $this->load->view('frontend/worksheet_list_page', $data);
    }
    public function english_worksheet(){
        $data['title']='Worksheets';
        $where='';
        $subject_id=get_id_by_slug('id','english','work_subjects');
        $where.=($where!='')?' AND work_subject_id='.$subject_id:' work_subject_id='.$subject_id;
        $data['worksheets']=$this->frontend_model->get_worksheets($where);
        $data['work_subjects']=$this->frontend_model->get_work_subjects();
        $data['work_grades']=$this->frontend_model->get_work_grades();
        $data['work_categories']=$this->frontend_model->get_work_categories();
        $data['work_topics']=$this->frontend_model->get_work_topics();
        $data['worksheetrating']=$this->frontend_model->get_worksheet_rating();
        $this->load->view('frontend/worksheet_list_page', $data);
    }
    public function worksheet_favourite(){
        $data['title']='Favourite Worksheets';
        $data['worksheets']=$this->frontend_model->get_favourite_worksheets(array('worksheet_favorite.user_id'=>get_current_user_id()));
        //print_r($data);
        /*$data['work_subjects']=$this->frontend_model->get_work_subjects();
        $data['work_grades']=$this->frontend_model->get_work_grades();
        $data['work_categories']=$this->frontend_model->get_work_categories();
        $data['work_topics']=$this->frontend_model->get_work_topics();*/
        $data['worksheetrating']=$this->frontend_model->get_worksheet_rating();
        $this->load->view('frontend/favourite_worksheet_v', $data);
    }
    public function worksheet_recent(){
        $data['title']='Recently viewed worksheets';
        $data['worksheets']=$this->frontend_model->get_worksheets('ID in ('.get_cookie('recent_work').')');
        $this->load->view('frontend/favourite_worksheet_v', $data);
    }
    public function worksheet($grade_slug,$subject_slug,$category_slug,$worksheet_slug){
	    $worksheet_id=$this->frontend_model->get_worksheet_by_slug(array('slug'=>$worksheet_slug));
	    //print_r($worksheet_id[0]->id); exit();
        $data['worksheets']=$this->frontend_model->get_worksheets(array('id'=>$worksheet_id[0]->id));
        $data['title']=get_returnfield('worksheets','id',$worksheet_id[0]->id,'name');
        $data['work_subjects']=$this->frontend_model->get_work_subjects();
        $data['work_grades']=$this->frontend_model->get_work_grades();
        $data['work_categories']=$this->frontend_model->get_work_categories();
        $data['work_topics']=$this->frontend_model->get_work_topics();
        $data['related_worksheets']=$this->frontend_model->get_related_worksheets($worksheet_id[0]->id);


        $this->load->view('frontend/worksheet_single_v', $data);
    }

	public function  subject_english(){
	    $data['title']='Subject Enlglish';

	    $data['subject']=$this->frontend_model->get_subject(array('name'=>'Math'));

	    $this->load->view('frontend/subject_english_page',$data);

    }

}