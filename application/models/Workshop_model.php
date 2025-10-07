<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Create a new workshop
    public function create_workshop($data)
    {
        $this->db->insert('workshops', $data);
        return $this->db->insert_id();
    }

    // Update a workshop
    public function update_workshop($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('workshops', $data);
    }

    // Delete a workshop
    public function delete_workshop($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('workshops');
    }

    // Get all workshops for admin view
    public function get_all_workshops($limit = null, $offset = null)
    {
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('start_datetime', 'DESC');
        return $this->db->get('workshops')->result();
    }

    // Get workshop by ID for admin (any status)
    public function get_workshop($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('workshops')->row();
    }

    // Get workshop by slug for public view
    public function get_workshop_by_slug($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where_in('status', ['published', 'coming soon']);
        return $this->db->get('workshops')->row();
    }

    // Get upcoming workshops
    public function get_upcoming_workshops($limit = 3)
    {
        $this->db->where('start_datetime >', date('Y-m-d H:i:s'));
        $this->db->where_in('status', ['published', 'coming soon']);
        $this->db->order_by('start_datetime', 'ASC');
        $this->db->limit($limit);
        return $this->db->get('workshops')->result();
    }

    // Add material to workshop
    public function add_material($workshop_id, $data)
    {
        $data['workshop_id'] = $workshop_id;
        $this->db->insert('workshop_materials', $data);
        return $this->db->insert_id();
    }

    // Get workshop materials
    public function get_materials($workshop_id)
    {
        return $this->db->get_where('workshop_materials', ['workshop_id' => $workshop_id])->result();
    }

    // Register participant
    public function register_participant($workshop_id, $user_id = null, $external_data = null)
    {
        $data = [
            'workshop_id' => $workshop_id,
            'registered_at' => date('Y-m-d H:i:s')
        ];

        if ($user_id) {
            $user = $this->db->get_where('users', ['id' => $user_id])->row();
            $data['user_id'] = $user_id;
            $data['role'] = in_array($user->role, ['student', 'teacher']) ? $user->role : 'external';
        } else {
            $data['external_name'] = $external_data['name'];
            $data['external_email'] = $external_data['email'];
            $data['role'] = 'external';
        }

        $this->db->insert('workshop_participants', $data);
        return $this->db->insert_id();
    }

    // Get workshop participants
    public function get_participants($workshop_id)
    {
        $this->db->select('wp.*, u.nama_lengkap, u.email, u.role as user_role, 
                          rp.name as province_name, rr.name as regency_name, rd.name as district_name');
        $this->db->from('workshop_participants wp');
        $this->db->join('users u', 'u.id = wp.user_id', 'left');
        $this->db->join('reg_provinces rp', 'rp.id = wp.province_id', 'left');
        $this->db->join('reg_regencies rr', 'rr.id = wp.regency_id', 'left');
        $this->db->join('reg_districts rd', 'rd.id = wp.district_id', 'left');
        $this->db->where('wp.workshop_id', $workshop_id);
        return $this->db->get()->result();
    }

    // Get all participants (members & guests) via view
    public function get_all_participants($workshop_id)
    {
        $this->db->select('
            vw.participant_id,
            vw.participant_id as id,
            vw.workshop_id,
            vw.user_id,
            vw.nama_lengkap,
            vw.email,
            vw.user_role,
            CASE WHEN vw.participant_type = \'guest\' THEN \'guest\' ELSE vw.participant_role END AS role,
            vw.participant_role,
            vw.status,
            vw.registered_at,
            vw.participant_type,
            vw.province_id,
            vw.regency_id,
            vw.district_id,
            vw.village_id,
            rp.name AS province_name,
            rr.name AS regency_name,
            rd.name AS district_name,
            rv.name AS village_name
        ');
        $this->db->from('view_workshop_all_participants vw');
        $this->db->join('reg_provinces rp', 'rp.id = vw.province_id', 'left');
        $this->db->join('reg_regencies rr', 'rr.id = vw.regency_id', 'left');
        $this->db->join('reg_districts rd', 'rd.id = vw.district_id', 'left');
        $this->db->join('reg_villages rv', 'rv.id = vw.village_id', 'left');
        $this->db->where('vw.workshop_id', $workshop_id);
        $this->db->order_by('vw.registered_at', 'ASC');

        return $this->db->get()->result();
    }

    // Get workshops by user
    public function get_user_workshops($user_id)
    {
        $this->db->select('w.*, wp.registered_at, wp.status as participation_status');
        $this->db->from('workshop_participants wp');
        $this->db->join('workshops w', 'w.id = wp.workshop_id');
        $this->db->where('wp.user_id', $user_id);
        return $this->db->get()->result();
    }

    // Check if user is registered for workshop
    public function is_user_registered($workshop_id, $user_id)
    {
        return $this->db->get_where('workshop_participants', [
            'workshop_id' => $workshop_id,
            'user_id' => $user_id
        ])->row();
    }

    // Get single participant by ID
    public function get_participant_by_id($participant_id)
    {
        return $this->db->get_where('workshop_participants', ['id' => $participant_id])->row();
    }

    // Delete participant by ID
    public function delete_participant_by_id($participant_id)
    {
        return $this->db->delete('workshop_participants', ['id' => $participant_id]);
    }

    // Get guest by ID
    public function get_guest_by_id($guest_id)
    {
        return $this->db->get_where('workshop_guests', ['id' => $guest_id])->row();
    }

    // Delete guest by ID
    public function delete_guest_by_id($guest_id)
    {
        return $this->db->delete('workshop_guests', ['id' => $guest_id]);
    }

    // Register guest for workshop
    public function register_guest($workshop_id, $guest_data)
    {
        $data = [
            'workshop_id' => $workshop_id,
            'nama_lengkap' => $guest_data['nama_lengkap'],
            'asal_kampus_sekolah' => $guest_data['asal_kampus_sekolah'],
            'usia' => $guest_data['usia'],
            'pekerjaan' => $guest_data['pekerjaan'],
            'no_wa_telegram' => $guest_data['no_wa_telegram'],
            'province_id' => !empty($guest_data['province_id']) ? $guest_data['province_id'] : null,
            'regency_id' => !empty($guest_data['regency_id']) ? $guest_data['regency_id'] : null,
            'district_id' => !empty($guest_data['district_id']) ? $guest_data['district_id'] : null,
            'village_id' => !empty($guest_data['village_id']) ? $guest_data['village_id'] : null,
            'registered_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('workshop_guests', $data);
        return $this->db->insert_id();
    }

    // Check if guest is already registered for workshop
    public function is_guest_registered($workshop_id, $no_wa_telegram)
    {
        return $this->db->get_where('workshop_guests', [
            'workshop_id' => $workshop_id,
            'no_wa_telegram' => $no_wa_telegram
        ])->row();
    }

    // Get guest registration details
    public function get_guest_registration($guest_id)
    {
        $this->db->select('wg.*, vr.province_name, vr.regency_name, vr.district_name, vr.village_name');
        $this->db->from('workshop_guests wg');
        $this->db->join('view_region_complete vr', 'vr.village_id = wg.village_id', 'left');
        $this->db->where('wg.id', $guest_id);

        return $this->db->get()->row();
    }

    // Get all guests for a workshop
    public function get_workshop_guests($workshop_id)
    {
        $this->db->select('workshop_guests.*');
        $this->db->from('workshop_guests');
        $this->db->where('workshop_guests.workshop_id', $workshop_id);
        $this->db->order_by('workshop_guests.registered_at', 'DESC');
        return $this->db->get()->result();
    }

    // Get guest statistics for a workshop
    public function get_guest_statistics($workshop_id)
    {
        $stats = [];

        // Total guests
        $stats['total_guests'] = $this->db->where('workshop_id', $workshop_id)->count_all_results('workshop_guests');

        // Guests by job
        $this->db->select('pekerjaan, COUNT(*) as count');
        $this->db->where('workshop_id', $workshop_id);
        $this->db->group_by('pekerjaan');
        $stats['guests_by_job'] = $this->db->get('workshop_guests')->result();

        // Guests by age group
        $this->db->select("
            CASE
                WHEN usia < 18 THEN 'Under 18'
                WHEN usia BETWEEN 18 AND 24 THEN '18-24'
                WHEN usia BETWEEN 25 AND 34 THEN '25-34'
                WHEN usia BETWEEN 35 AND 44 THEN '35-44'
                ELSE '45+'
            END as age_group,
            COUNT(*) as count
        ");
        $this->db->where('workshop_id', $workshop_id);
        $this->db->group_by('age_group');
        $stats['guests_by_age'] = $this->db->get('workshop_guests')->result();

        return $stats;
    }

    // Get regional data for dropdowns
    public function get_provinces()
    {
        return $this->db->get('reg_provinces')->result();
    }

    public function get_regencies($province_id = null)
    {
        if ($province_id) {
            $this->db->where('province_id', $province_id);
        }
        return $this->db->get('reg_regencies')->result();
    }

    public function get_districts($regency_id = null)
    {
        if ($regency_id) {
            $this->db->where('regency_id', $regency_id);
        }
        return $this->db->get('reg_districts')->result();
    }

    public function get_villages($district_id = null)
    {
        if ($district_id) {
            $this->db->where('district_id', $district_id);
        }
        return $this->db->get('reg_villages')->result();
    }

    // Get district name by ID
    public function get_district_name($district_id)
    {
        $district = $this->db->get_where('reg_districts', ['id' => $district_id])->row();
        return $district ? $district->name : '';
    }

    // Get province name by ID
    public function get_province_name($province_id)
    {
        $province = $this->db->get_where('reg_provinces', ['id' => $province_id])->row();
        return $province ? $province->name : '';
    }

    // Get regency name by ID
    public function get_regency_name($regency_id)
    {
        $regency = $this->db->get_where('reg_regencies', ['id' => $regency_id])->row();
        return $regency ? $regency->name : '';
    }

    // Get participant details with regional information
    public function get_participant_details($workshop_id, $user_id)
    {
        $this->db->select('wp.*, u.nama_lengkap, u.email, u.role as user_role, 
                          rp.name as province_name, rr.name as regency_name, rd.name as district_name');
        $this->db->from('workshop_participants wp');
        $this->db->join('users u', 'u.id = wp.user_id', 'left');
        $this->db->join('reg_provinces rp', 'rp.id = wp.province_id', 'left');
        $this->db->join('reg_regencies rr', 'rr.id = wp.regency_id', 'left');
        $this->db->join('reg_districts rd', 'rd.id = wp.district_id', 'left');
        $this->db->where('wp.workshop_id', $workshop_id);
        $this->db->where('wp.user_id', $user_id);
        return $this->db->get()->row();
    }
}
