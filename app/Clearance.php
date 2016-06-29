<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\Csv\Writer;

class Clearance extends Model
{
    protected $table = 'clearance';

    protected $fillable = ['full_name','phone','registration_number','teller_number','serial_number','pin_number','user_id'];

    public function newPinSlip($data, $user)
    {
        $user_id = $user->id;
        // Check if registration number has been cleared
        if(! $this->where('registration_number', $data['registration_number'])->where('teller_number',$data['teller_number'])->exists()){
            // generate Unique PIN number
            $pin_number = $this->generateUniquePIN(12); // Generate a 12 Digit PIN
            $serial_number = $this->generateUniqueSerialNumber(8); // Generate an 8 Digit Serial Number
            $date = new \DateTime('now', new \DateTimeZone('Africa/Lagos'));
            $pinSlip = $this->create([
                'full_name' => Str::title($data['fullname']),
                'phone' => $data['phone'],
                'registration_number' => trim($data['registration_number']),
                'teller_number' => $data['teller_number'],
                'serial_number' => $this->formatSerialNumber($serial_number),
                'pin_number' => $pin_number,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        } else {
            // return the id of the existing registration number
            $pinSlip = $this->where('registration_number',$data['registration_number'])->first();
        }
        return $pinSlip ? $pinSlip->id : false;
    }

    public function clearanceList()
    {
        return $this->orderBy('created_at', 'desc')->get();
    }

    public function clearanceSlipDetail($id)
    {
        return $this->whereId($id)->first();
    }

    public function deletePinSlip($id)
    {
        return $this->whereId($id)->delete();
    }

    public function exportCSV()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csvColumnHeaders = ['Full Name', 'Registration Number', 'PIN Number', 'Serial Number', 'Teller Number', 'Phone'];
        $csv->insertOne($csvColumnHeaders);
        $this->get([
            'full_name',
            'registration_number',
            'pin_number',
            'serial_number',
            'teller_number',
            'phone',
        ])->each(function($clearance) use($csv) {
            $csv->insertOne($clearance->toArray());
        });;

        // Output to browser - Download file
        $csv->output('clearance.csv');

    }

    protected function generateUniquePIN($length = 12){
        $pin_number = $this->generateNumber($length);
        $check_pin = $this->where('pin_number', $pin_number)->exists();
        // Recurse the number generation
        if($check_pin){
            $this->generateUniquePIN($length);
        }
        return $pin_number;
    }

    protected function generateUniqueSerialNumber($length = 8){
        $serial_number = $this->generateNumber($length);
        $check_serial_number = $this->where('serial_number', $serial_number)->exists();
        // Recurse the number generation
        if($check_serial_number){
            $this->generateUniqueSerialNumber($length);
        }
        return $serial_number;
    }

    protected function generateNumber($digits){
        $i = 0;
        $number = "";
        while($i < $digits){
            $number .= mt_rand(0, 9);
            $i++;
        }
        return $number;
    }

    protected function formatSerialNumber($serial_number){
        return 'UM' . $serial_number;
    }
}
