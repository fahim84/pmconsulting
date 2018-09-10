<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/ICObenchAPI.php');

class Cron extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	

	public function icobench()
    {
        if($this->uri->segment(4) != '')
        {
            $status = $this->uri->segment(4);
        }
        else
        {
            $status = $this->input->get_post('status') ? $this->input->get_post('status') : 'ongoing';
        }

        $query_params['status'] = $status;
        $query_params['orderDesc'] = "rating";
        # Pagination Code
        if($this->uri->segment(3) != '')
        {
            $page = $this->uri->segment(3);
        }
        else
        {
            $page = $this->input->get_post('page') !== NULL ? $this->input->get_post('page') : 1;
        }
        $query_params['page'] = $page-1; // less 1 because api page start from zero

        $limit = 12;

        $api = new ICObenchAPI();
        $api->getICOs("all",$query_params);

        $api_response = json_decode($api->result);

        $total_rows = $api_response->icos;
        $rows = $api_response->results;

        foreach ($rows as $row)
        {
            $sql_data['id'] = $row->id;
            $sql_data['name'] = $row->name;
            $sql_data['url'] = $row->url;
            $sql_data['logo'] = $row->logo;
            $sql_data['desc'] = $row->desc;
            $sql_data['rating'] = $row->rating;
            $sql_data['premium'] = $row->premium;
            $sql_data['raised'] = $row->raised;
            $sql_data['preIcoStart'] = $row->dates->preIcoStart;
            $sql_data['preIcoEnd'] = $row->dates->preIcoEnd;
            $sql_data['icoStart'] = $row->dates->icoStart == '0000-00-00 00:00:00' ? $row->dates->preIcoStart : $row->dates->icoStart;
            $sql_data['icoEnd'] = $row->dates->icoEnd == '0000-00-00 00:00:00' ? $row->dates->preIcoEnd : $row->dates->icoEnd;
            $sql_data['status'] = 1;
            $sql_data['ico_type'] = $status;

            my_var_dump($sql_data);
            $insert_query = $this->db->insert_string('icos', $sql_data);
            $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
            $this->db->query($insert_query);
            unset($sql_data);

            if($id = $this->db->insert_id())
            {
                $api = new ICObenchAPI();
                $api->getICO($row->id);
                $detail = $api->result;

                $this->db->where('id',$id);
                $this->db->update('icos',['detail'=>$detail]);
            }
        }
        # array for pagination query string
        $qstr['status'] = $status;

        $page_query_string = '?'.http_build_query($qstr);
        $config['base_url'] = base_url('welcome/index/'.$page_query_string);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        $this->data['pagination_links'] = $this->pagination->create_links();
        // Paination code end

        //echo $this->data['pagination_links'];

        if($status == 'ongoing' and count($rows) < 12)
        {
            $page = 0;
            $status = 'upcoming';
            $url = base_url().'cron/icobench/'.++$page.'/'.$status;
            my_var_dump('redirecting... '.$url);
            my_var_dump("<a href='$url'>$url</a>");
            //redirect($url);
            ?>
            <script>
                window.location.href = "<?php echo $url; ?>";
            </script>
            <?php
        }
        if($status == 'upcoming' and count($rows) < 12)
        {
            // finish cron job
            my_var_dump('cron job finished on page '.$page);
            exit;
        }

        if($page < 5 and $status == 'ongoing')
        {
            $url = base_url().'cron/icobench/'.++$page.'/'.$status;
            my_var_dump('redirecting... '.$url);
            my_var_dump("<a href='$url'>$url</a>");
            //redirect($url);
            ?>
            <script>
                window.location.href = "<?php echo $url; ?>";
            </script>
            <?php
        }
        elseif($page == 5 and $status == 'ongoing')
        {
            $page = 0;
            $status = 'upcoming';
            $url = base_url().'cron/icobench/'.++$page.'/'.$status;
            my_var_dump('redirecting... '.$url);
            my_var_dump("<a href='$url'>$url</a>");
            //redirect($url);
            ?>
            <script>
                window.location.href = "<?php echo $url; ?>";
            </script>
            <?php
        }

        if($page < 5 and $status == 'upcoming')
        {
            $url = base_url().'cron/icobench/'.++$page.'/'.$status;
            my_var_dump('redirecting... '.$url);
            my_var_dump("<a href='$url'>$url</a>");
            //redirect($url);
            ?>
            <script>
                window.location.href = "<?php echo $url; ?>";
            </script>
            <?php
        }
        else
        {
            my_var_dump('Updating prices of ETH and BTC');

            $api_end_point = "https://api.coinbase.com/v2/exchange-rates?currency=BTC";
            my_var_dump($api_end_point);
            $response = file_get_contents($api_end_point);
            if($response)
            {
                $response = json_decode($response);
                //my_var_dump($response);

                $datetime = date('Y-m-d H:i:s');
                $sql_data['name'] = $response->data->currency;
                $sql_data['fullname'] = $response->data->currency;
                $sql_data['price'] = $response->data->rates->USD;
                $sql_data['currency'] = 'USD';
                $sql_data['updated_at'] = $datetime;

                $sql = $this->db->insert_string('currencies', $sql_data) . " ON DUPLICATE KEY UPDATE price={$response->data->rates->USD},updated_at='$datetime'";
                $this->db->query($sql);
                my_var_dump($this->db->last_query());
                $id = $this->db->insert_id();
                my_var_dump($id);

            }
            else{
                my_var_dump($response);
            }

            $api_end_point = "https://api.coinbase.com/v2/exchange-rates?currency=ETH";
            my_var_dump($api_end_point);
            $response = file_get_contents($api_end_point);
            if($response)
            {
                $response = json_decode($response);
                //my_var_dump($response);

                $datetime = date('Y-m-d H:i:s');
                $sql_data['name'] = $response->data->currency;
                $sql_data['fullname'] = $response->data->currency;
                $sql_data['price'] = $response->data->rates->USD;
                $sql_data['currency'] = 'USD';
                $sql_data['updated_at'] = $datetime;

                $sql = $this->db->insert_string('currencies', $sql_data) . " ON DUPLICATE KEY UPDATE price={$response->data->rates->USD},updated_at='$datetime'";
                $this->db->query($sql);
                my_var_dump($this->db->last_query());
                $id = $this->db->insert_id();
                my_var_dump($id);

            }
            else{
                my_var_dump($response);
            }


            my_var_dump('cron job finished on page '.$page);
        }
    }

    public function test()
    {
        error_reporting(E_ALL);
        echo $fahim;
    }
}