<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parts extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    $this->load->database();
	    $query = $this->db->query('SELECT * FROM parts');
            $parts = $query->result_array()
            $this->load->library('table');
            $parms = array(
                'table_open' => '<table class="gallery">',
                'cell_start' => '<td class="oneimage">',
                'cell_alt_start' => '<td calss="oneimage">'
            );

            $this->table->set_template($parms);

            $list = array();
            foreach ($parts as $part)
            {
                $list[] = array (
                    'piece' => $part['piece'],
                    'mug' => $part['mug'],
                    'what' => $part['what']);
            }

            foreach($list as $x){
                $cells[] = $this->parser->parse('_cell', (array) $x, true);
            }

            $rows = $this->table->make_columns($cells, 3);
            $this->data['thetable'] = $this->table->generate($rows);
            $this->data['pagebody'] = 'parts';
            $this->render();
        }

        public function item($id) {
            // view we want shown
            $this->data['pagebody'] = 'justone';
            $source = $this->inventory->get($id);

            // pull data from quotes data
            $this->data['date'] = $source['date'];
            $this->data['what'] = $source['what'];
            $this->data['mug'] = $source['mug'];
            $this->data['CA'] = $source['CA'];

            $this->render();
        }

}
