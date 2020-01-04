<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Evencal Controller for Multiple Events Calendar
 *
 * Author       : Moch Zawaruddin Abdullah
 * Date Created : 25 May 2013
 * Version      : 1.0
 * Website		: zawaruddin.blogspot.com
 * 
 * This application just for share, please contact me at zawaruddin017@gmail.com if you have an idea for improve this application. ^_^
 */

class Evencal extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('evencal_model', 'evencal');
		$this->load->library('calendar', $this->_setting());
	}
	
	function index($year = null, $month = null, $day = null){
		$year  = (empty($year) || !is_numeric($year))?  date('Y') :  $year;
		$month = (is_numeric($month) &&  $month > 0 && $month < 13)? $month : date('m');
		$day   = (is_numeric($day) &&  $day > 0 && $day < 31)?  $day : date('d');
		
		$date      = $this->evencal->getDateEvent($year, $month);
		$cur_event = $this->evencal->getEvent($year, $month, $day);
		$data      = array(
						'notes' => $this->calendar->generate($year, $month, $date),
						'year'  => $year, 
						'mon'   => $month,
						'month' => $this->_month($month),
						'day'   => $day,
						'events'=> $cur_event
					);
		$this->load->view('index', $data);
	}
	
	// for convert (int) month to (string) month in Indonesian
	function _month($month){
		$month = (int) $month;
		switch($month){
			case 1 : $month = 'Enero'; Break;
			case 2 : $month = 'Febrero'; Break;
			case 3 : $month = 'Marzo'; Break;
			case 4 : $month = 'Abril'; Break;
			case 5 : $month = 'Mayo'; Break;
			case 6 : $month = 'Junio'; Break;
			case 7 : $month = 'Julio'; Break;
			case 8 : $month = 'Agosto'; Break;
			case 9 : $month = 'Setiembre'; Break;
			case 10 : $month = 'Octubre'; Break;
			case 11 : $month = 'Noviembre'; Break;
			case 12 : $month = 'Diciembre'; Break;
		}
		return $month;
	}
	
	// get detail event for selected date
	function detail_event(){		
		$this->form_validation->set_rules('year', 'Year', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('mon', 'Month', 'trim|required|is_natural_no_zero|less_than[13]');
		$this->form_validation->set_rules('day', 'Day', 'trim|required|is_natural_no_zero|less_than[32]');
		
		if ($this->form_validation->run() == FALSE){
			echo json_encode(array('status' => false, 'title_msg' => 'Error', 'msg' => 'Please insert valid value'));
		}else{
			$data = $this->evencal->getEvent($this->input->post('year', true), $this->input->post('mon', true), $this->input->post('day', true));
			if($data == null){
				echo json_encode(array('status' => false, 'title_msg' => 'No Hay eventos', 'msg' => 'No hay evento en esta fecha'));
			}else{			
				echo json_encode(array('status' => true, 'data' => $data));
			}
		}
	}
	
	// popup for adding event
	function add_event(){
		$data = array(
					'day'   => $this->input->post('day', true),
					'mon'   => $this->input->post('mon', true),
					'month' => $this->_month($this->input->post('mon', true)),
					'year'  => $this->input->post('year', true),
				);
		$this->load->view('add_event', $data);
	}
	
	// do adding event for selected date
	function do_add(){
		$this->form_validation->set_rules('year', 'Year', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('mon', 'Month', 'trim|required|is_natural_no_zero|less_than[13]');
		$this->form_validation->set_rules('day', 'Day', 'trim|required|is_natural_no_zero|less_than[32]');
		$this->form_validation->set_rules('hour', 'Hour', 'trim|required');
		$this->form_validation->set_rules('minute', 'Minute', 'trim|required');
		$this->form_validation->set_rules('event', 'Event', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			echo json_encode(array('status' => false, 'title_msg' => 'Error', 'msg' => 'Please insert valid value'));
		}else{
			$this->evencal->addEvent($this->input->post('year', true), 
											 $this->input->post('mon', true), 
											 $this->input->post('day', true), 
											 $this->input->post('hour', true).":".$this->input->post('minute', true).":00",
											 $this->input->post('event', true));
			echo json_encode(array('status' => true, 'time' => $this->input->post('time', true), 'event' => $this->input->post('event', true)));
		}
	}
	
	// delete event
	function delete_event(){
		$this->form_validation->set_rules('year', 'Year', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('mon', 'Month', 'trim|required|is_natural_no_zero|less_than[13]');
		$this->form_validation->set_rules('day', 'Day', 'trim|required|is_natural_no_zero|less_than[32]');
		$this->form_validation->set_rules('del', 'ID', 'trim|required|is_natural_no_zero');
		
		if ($this->form_validation->run() == FALSE){
			echo json_encode(array('status' => false));
		}else{
			$rows = $this->evencal->deleteEvent($this->input->post('year', true),$this->input->post('mon', true),$this->input->post('day', true), $this->input->post('del', true));
			if($rows > 0){
				echo json_encode(array('status' => true, 'row' => $rows));
			}else{
				echo json_encode(array('status' => true, 'row' => $rows, 'title_msg' => 'No Event', 'msg' => 'There\'s no event in this date'));
			}
		}
	}
	
	// same as index() function
	function detail($year = null, $month = null, $day = null){
		$year  = (empty($year) || !is_numeric($year))?  date('Y') :  $year;
		$month = (is_numeric($month) &&  $month > 0 && $month < 13)? $month : date('m');
		$day   = (is_numeric($day) &&  $day > 0 && $day < 31)?  $day : date('d');
		
		$date      = $this->evencal->getDateEvent($year, $month);
		$cur_event = $this->evencal->getEvent($year, $month, $day);
		echo "<pre>";
		print_r ($cur_event);
		echo "</pre>";
		$data 	   = array(
						'notes' => $this->calendar->generate($year, $month, $date),
						'year'  => $year,
						'mon'   => $month,
						'month' => $this->_month($month),
						'day'   => $day,
						'events'=> $cur_event
					);
		$this->load->view('index', $data);
	}
	
	// setting for calendar
	function _setting(){
		return array(
			'start_day' 		=> 'sunday',
			'show_next_prev' 	=> true,
			'next_prev_url' 	=> base_url('evencal/index'),
			'month_type'   		=> 'long',
            'day_type'     		=> 'short',
			'template' 			=> '{table_open}<table class="date1">{/table_open}
								   {heading_row_start}&nbsp;{/heading_row_start}
								   {heading_previous_cell}<caption><a href="{previous_url}" class="prev_date" title="Mes anterior"><button class="btn btn-secondary btn-circle btn-circle-sm m-1"><i class="fa fa-angle-left"></i></button></a>{/heading_previous_cell}
								   {heading_title_cell}{heading}{/heading_title_cell}
								   {heading_next_cell}<a href="{next_url}" class="next_date"  title="Próximo mes"><button class="btn btn-secondary btn-circle btn-circle-sm m-1"><i class="fa fa-angle-right"></i></button></a></caption>{/heading_next_cell}
								   {heading_row_end}<col class="weekday" span="5"><col class="weekend_sat"><col class="weekend_sun">{/heading_row_end}
                                   {week_row_start}
                                   <thead>
                                    <tr>
                                        {/week_row_start}
                                        {week_day_cell}
                                            <th>{week_day}</th>
                                        {/week_day_cell}
                                        {week_row_end}
                                    </tr>
                                   </thead>
                                   <tbody>
                                    {/week_row_end}
                                    {cal_row_start}
                                        <tr>{/cal_row_start}
                                            {cal_cell_start}
                                            <td>{/cal_cell_start}
                                                {cal_cell_content}
                                                <div class="date_event detail" val="{day}">
                                                    <span class="date">{day}</span>
                                                    <span class="event btn btn-dark btn-circle btn-circle-sm m-1{day}">{content}</span>
                                                </div>{/cal_cell_content}
                                                    {cal_cell_no_content}
                                                    <div class="active_no_event detail" val="{day}">
                                                        <span class="date">{day}</span>
                                                        <span class="event d{day}">&nbsp;</span>
                                                    </div>
                                                    {/cal_cell_no_content}
                                                    {cal_cell_no_content_today}
                                                    <div class="active_no_event detail" val="{day}">
                                                        <span class="date">{day}</span>
                                                        <span class="event d{day}">&nbsp;</span>
                                                    </div>
                                                    {cal_cell_prueba}
                                                    <div class="active_event_actual detail" >
                                                    </div>
                                                    {/cal_cell_prueba}
                                                    {/cal_cell_no_content_today}
                                                {cal_cell_blank}&nbsp;{/cal_cell_blank}
                                                {cal_cell_end}
                                            </td>{/cal_cell_end}
                                            {cal_row_end}
                                        </tr>{/cal_row_end}
                                    {table_close}
                                   </tbody>
                                </table>{/table_close}');
	}


	function detalle($year = null, $month = null, $day = null){
		$year  = (empty($year) || !is_numeric($year))?  date('2020') :  $year;
		$month = (is_numeric($month) &&  $month > 0 && $month < 13)? $month : date('01');
		$day   = (is_numeric($day) &&  $day > 0 && $day < 31)?  $day : date('4');
		
		$date      = $this->evencal->getDateEvent($year, $month);

		$cur_event = $this->evencal->getEvent($year, $month, $day);
		$data      = array(
						'notes' => $this->calendar->generate($year, $month, $date),
						'year'  => $year, 
						'mon'   => $month,
						'month' => $this->_month($month),
						'day'   => $day,
						'events'=> $cur_event
					);
		$this->load->view('detalle', $data);
	}
}