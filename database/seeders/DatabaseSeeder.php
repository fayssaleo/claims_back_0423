<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\Brand\Models\Brand;
use App\Modules\Department\Models\Department;
use App\Modules\EquipmentMatricule\Models\EquipmentMatricule;
use App\Modules\Fonction\Models\Fonction;
use App\Modules\NatureOfDamage\Models\NatureOfDamage;
use App\Modules\TypeOfEquipment\Models\TypeOfEquipment;
use App\Modules\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $department=new Department();
        $department->name="IT";
        $department->save();

        $department=new Department();
        $department->name="OPERATIONS";
        $department->save();

        $department=new Department();
        $department->name="QHSSE";
        $department->save();

        $department=new Department();
        $department->name="TECHNICAL";
        $department->save();

        $department=new Department();
        $department->name="FINANCE";
        $department->save();










        $brand=new Brand();
        $brand->name="KONECRANES";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="Liebherr";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="DOOSAN";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="YALE";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="BROMMA";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="FABRISEM";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="TERBERG";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="SEACOM AG";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="COMATO";
        $brand->categorie="Equipment";
        $brand->save();

        $brand=new Brand();
        $brand->name="TEC Container";
        $brand->categorie="Equipment";
        $brand->save();












//---------------------------------------------------------------------------------------

        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Ship to shores";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="01";
        $equipment_matricule->matricule="CC2114";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="02";
        $equipment_matricule->matricule="CC2115";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="03";
        $equipment_matricule->matricule="CC2116";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="04";
        $equipment_matricule->matricule="CC2117";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="05";
        $equipment_matricule->matricule="CC2118";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="06";
        $equipment_matricule->matricule="CC2120";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="07";
        $equipment_matricule->matricule="CC2125";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="08";
        $equipment_matricule->matricule="CC2130";
        $equipment_matricule->equipment="Ship to shores";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();

//---------------------------------------------------------------------------------------


        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="RTGs";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="01";
        $equipment_matricule->matricule="G2439";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="02";
        $equipment_matricule->matricule="G2440";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="03";
        $equipment_matricule->matricule="G2441";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="04";
        $equipment_matricule->matricule="G2442";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="05";
        $equipment_matricule->matricule="G2443";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="06";
        $equipment_matricule->matricule="G2444";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="07";
        $equipment_matricule->matricule="G2445";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="08";
        $equipment_matricule->matricule="G2446";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="09";
        $equipment_matricule->matricule="G2447";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="10";
        $equipment_matricule->matricule="G2448";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="11";
        $equipment_matricule->matricule="G2449";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="12";
        $equipment_matricule->matricule="G2450";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="13";
        $equipment_matricule->matricule="G2451";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="14";
        $equipment_matricule->matricule="G2452";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="15";
        $equipment_matricule->matricule="G2453";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="16";
        $equipment_matricule->matricule="G2454";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="17";
        $equipment_matricule->matricule="G2541";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="18";
        $equipment_matricule->matricule="G2542";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="19";
        $equipment_matricule->matricule="G2543";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="20";
        $equipment_matricule->matricule="G2544";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="21";
        $equipment_matricule->matricule="G2545";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="22";
        $equipment_matricule->matricule="G2546";
        $equipment_matricule->equipment="RTGs";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();



//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Tablet";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();
//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Reach stackers";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="01";
        $equipment_matricule->matricule="M12560";
        $equipment_matricule->equipment="Reach stackers";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="02";
        $equipment_matricule->matricule="M12561";
        $equipment_matricule->equipment="Reach stackers";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="03";
        $equipment_matricule->matricule="M12562";
        $equipment_matricule->equipment="Reach stackers";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="04";
        $equipment_matricule->matricule="M12563";
        $equipment_matricule->equipment="Reach stackers";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();
//---------------------------------------------------------------------------------------

        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Forklifts";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FK 01";
        $equipment_matricule->matricule="M12618";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FK 02";
        $equipment_matricule->matricule="M12619";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="KONECRANES";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL01";
        $equipment_matricule->matricule="FDB04-1130-03181  type D";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="Doosan";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL02";
        $equipment_matricule->matricule="FDB04-1130-03182  type D";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="Doosan";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL03";
        $equipment_matricule->matricule="FBB07-1390-00033 Type EE";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="Doosan";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL04";
        $equipment_matricule->matricule="A7S1A02877U";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="YALE";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL05";
        $equipment_matricule->matricule="A7S1A02878U";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="YALE";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL06";
        $equipment_matricule->matricule="A7S1A02879U";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="YALE";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="FL07";
        $equipment_matricule->matricule="A7S1A02880U";
        $equipment_matricule->equipment="Forklifts";
        $equipment_matricule->brand="YALE";
        $equipment_matricule ->save();
//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Spreaders STS";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="01";
        $equipment_matricule->matricule="30994";
        $equipment_matricule->equipment="Spreaders STS";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();
//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Spreaders RTG";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="01";
        $equipment_matricule->matricule="31357";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="02";
        $equipment_matricule->matricule="31356";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="03";
        $equipment_matricule->matricule="31355";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="04";
        $equipment_matricule->matricule="31352";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="05";
        $equipment_matricule->matricule="31353";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="06";
        $equipment_matricule->matricule="31354";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="07";
        $equipment_matricule->matricule="30764";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="08";
        $equipment_matricule->matricule="30757";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="09";
        $equipment_matricule->matricule="30765";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="10";
        $equipment_matricule->matricule="30751";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="11";
        $equipment_matricule->matricule="30761";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="12";
        $equipment_matricule->matricule="30755";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="13";
        $equipment_matricule->matricule="30752";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="14";
        $equipment_matricule->matricule="30756";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="15";
        $equipment_matricule->matricule="30754";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="16";
        $equipment_matricule->matricule="30760";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="17";
        $equipment_matricule->matricule="30762";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="18";
        $equipment_matricule->matricule="30763";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="19";
        $equipment_matricule->matricule="30753";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="20";
        $equipment_matricule->matricule="30749";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="21";
        $equipment_matricule->matricule="30750";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="22";
        $equipment_matricule->matricule="30758";
        $equipment_matricule->equipment="Spreaders RTG";
        $equipment_matricule->brand="BROMMA";
        $equipment_matricule ->save();


//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Trucks";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="RR 01";
        $equipment_matricule->matricule="XLWRT2230L8369212";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();


        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="RR 02";
        $equipment_matricule->matricule="XLWRT2230L8369211";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 01";
        $equipment_matricule->matricule="XLWYT2220L9499181";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 02";
        $equipment_matricule->matricule="XLWYT2220L9579189";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 03";
        $equipment_matricule->matricule="XLWYT2220L9639195";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 04";
        $equipment_matricule->matricule="XLWYT2220L9759207";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 05";
        $equipment_matricule->matricule="XLWYT2221L9479179";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 06";
        $equipment_matricule->matricule="XLWYT2221L9539185";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 07";
        $equipment_matricule->matricule="XLWYT2221L9719203";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 08";
        $equipment_matricule->matricule="XLWYT2222L9589190";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 09";
        $equipment_matricule->matricule="XLWYT2222L9669198";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 10";
        $equipment_matricule->matricule="XLWYT2223L9489180";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 11";
        $equipment_matricule->matricule="XLWYT2223L9569188";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 12";
        $equipment_matricule->matricule="XLWYT2223L9629194";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 13";
        $equipment_matricule->matricule="XLWYT2223L9749206";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 14";
        $equipment_matricule->matricule="XLWYT2224L9469178";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 15";
        $equipment_matricule->matricule="XLWYT2224L9529184";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 16";
        $equipment_matricule->matricule="XLWYT2224L9709202";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 17";
        $equipment_matricule->matricule="XLWYT2225L9659197";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 18";
        $equipment_matricule->matricule="XLWYT2225L9699201";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 19";
        $equipment_matricule->matricule="XLWYT2225L9779209";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 20";
        $equipment_matricule->matricule="XLWYT2226L9559187";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 21";
        $equipment_matricule->matricule="XLWYT2226L9619193";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 22";
        $equipment_matricule->matricule="XLWYT2226L9739205";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 23";
        $equipment_matricule->matricule="XLWYT2227L9459177";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 24";
        $equipment_matricule->matricule="XLWYT2227L9519183";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 25";
        $equipment_matricule->matricule="XLWYT2227L9789210";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 26";
        $equipment_matricule->matricule="XLWYT2228L9649196";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 27";
        $equipment_matricule->matricule="XLWYT2228L9689200";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 28";
        $equipment_matricule->matricule="XLWYT2228L9769208";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 29";
        $equipment_matricule->matricule="XLWYT2229L9549186";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 30";
        $equipment_matricule->matricule="XLWYT2229L9609192";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 31";
        $equipment_matricule->matricule="XLWYT2229L9729204";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 32";
        $equipment_matricule->matricule="XLWYT222XL9449176";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 33";
        $equipment_matricule->matricule="XLWYT222XL9509182";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 34";
        $equipment_matricule->matricule="XLWYT222XL9599191";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 35";
        $equipment_matricule->matricule="XLWYT222XL9679199";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 36";
        $equipment_matricule->matricule="XLWYT2225M1710343";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 37";
        $equipment_matricule->matricule="XLWYT2222M1720344";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 38";
        $equipment_matricule->matricule="XLWYT222XM1730345";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 39";
        $equipment_matricule->matricule="XLWYT2227M1740346";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="TT 40";
        $equipment_matricule->matricule="XLWYT2224M1750347";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="TERBERG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="Trailer  Generator";
        $equipment_matricule->matricule="NRKTR2H22LAXX0001";
        $equipment_matricule->equipment="Trucks";
        $equipment_matricule->brand="EROGLU";
        $equipment_matricule ->save();


//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Trailers";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="1";
        $equipment_matricule->matricule="VV9FDT000LZ121041";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="2";
        $equipment_matricule->matricule="VV9FDT000LZ121042";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="3";
        $equipment_matricule->matricule="VV9FDT000LZ121043";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="4";
        $equipment_matricule->matricule="VV9FDT000LZ121044";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="5";
        $equipment_matricule->matricule="VV9FDT000LZ121045";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="6";
        $equipment_matricule->matricule="VV9FDT000LZ121046";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="7";
        $equipment_matricule->matricule="VV9FDT000LZ121047";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="8";
        $equipment_matricule->matricule="VV9FDT000LZ121048";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="9";
        $equipment_matricule->matricule="VV9FDT000LZ121049";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="10";
        $equipment_matricule->matricule="VV9FDT000LZ121050";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="11";
        $equipment_matricule->matricule="VV9FDT000LZ121051";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="12";
        $equipment_matricule->matricule="VV9FDT000LZ121052";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="13";
        $equipment_matricule->matricule="VV9FDT000LZ121053";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="14";
        $equipment_matricule->matricule="VV9FDT000LZ121054";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="15";
        $equipment_matricule->matricule="VV9FDT000LZ121055";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="16";
        $equipment_matricule->matricule="VV9FDT000LZ121056";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="17";
        $equipment_matricule->matricule="VV9FDT000LZ121057";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="18";
        $equipment_matricule->matricule="VV9FDT000LZ121058";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="19";
        $equipment_matricule->matricule="VV9FDT000LZ121059";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="20";
        $equipment_matricule->matricule="VV9FDT000LZ121060";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="21";
        $equipment_matricule->matricule="VV9FDT000LZ121061";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="22";
        $equipment_matricule->matricule="VV9FDT000LZ121062";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="23";
        $equipment_matricule->matricule="VV9FDT000LZ121063";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="24";
        $equipment_matricule->matricule="VV9FDT000LZ121064";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="25";
        $equipment_matricule->matricule="VV9FDT000LZ121065";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="26";
        $equipment_matricule->matricule="VV9FDT000LZ121066";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="27";
        $equipment_matricule->matricule="VV9FDT000LZ121067";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="28";
        $equipment_matricule->matricule="VV9FDT000LZ121068";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="29";
        $equipment_matricule->matricule="VV9FDT000LZ121069";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="30";
        $equipment_matricule->matricule="VV9FDT000LZ121070";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="31";
        $equipment_matricule->matricule="VV9FDT000LZ121071";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="32";
        $equipment_matricule->matricule="VV9FDT000LZ121072";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="33";
        $equipment_matricule->matricule="VV9FDT000LZ121073";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="34";
        $equipment_matricule->matricule="VV9FDT000LZ121074";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="35";
        $equipment_matricule->matricule="VV9FDT000LZ121075";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="36";
        $equipment_matricule->matricule="VV9FDT000LZ121076";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="37";
        $equipment_matricule->matricule="VV9FDT000LZ121077";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="38";
        $equipment_matricule->matricule="VV9FDT000LZ121078";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="39";
        $equipment_matricule->matricule="VV9FDT000MZ121041";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="40";
        $equipment_matricule->matricule="VV9FDT000MZ121042";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="41";
        $equipment_matricule->matricule="VV9FDT000MZ121043";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="42";
        $equipment_matricule->matricule="VV9FDT000MZ121044";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="43";
        $equipment_matricule->matricule="VV9FDT000MZ121045";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="44";
        $equipment_matricule->matricule="VV9FDT000MZ121046";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="45";
        $equipment_matricule->matricule="VV9FDT000MZ121047";
        $equipment_matricule->equipment="Trailers";
        $equipment_matricule->brand="FABRISEM";
        $equipment_matricule ->save();

//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Goosenecks";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="1";
        $equipment_matricule->matricule="80401-01";
        $equipment_matricule->equipment="Goosenecks";
        $equipment_matricule->brand="SEACOM  AG";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="2";
        $equipment_matricule->matricule="C-20005 SH 36t";
        $equipment_matricule->equipment="Goosenecks";
        $equipment_matricule->brand="COMATO";
        $equipment_matricule ->save();


//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Lashing cages";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="1";
        $equipment_matricule->matricule="4558";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="2";
        $equipment_matricule->matricule="4559";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="3";
        $equipment_matricule->matricule="4560";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="4";
        $equipment_matricule->matricule="4561";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="5";
        $equipment_matricule->matricule="4562";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="6";
        $equipment_matricule->matricule="4563";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="7";
        $equipment_matricule->matricule="4564";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="8";
        $equipment_matricule->matricule="4565";
        $equipment_matricule->equipment="Lashing cages";
        $equipment_matricule->brand="TEC Container";
        $equipment_matricule ->save();

//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Test Weightlifting frame";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="1";
        $equipment_matricule->matricule="13012548";
        $equipment_matricule->equipment="Test Weightlifting frame";
        $equipment_matricule->brand="Liebherr";
        $equipment_matricule ->save();

//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Hook Beam";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="1";
        $equipment_matricule->matricule="CC2114";
        $equipment_matricule->equipment="Hook Beam";
        $equipment_matricule->brand="-";
        $equipment_matricule ->save();

//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Hook Frame";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="1";
        $equipment_matricule->matricule="4677";
        $equipment_matricule->equipment="Hook Frame";
        $equipment_matricule->brand="-";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="2";
        $equipment_matricule->matricule="4676";
        $equipment_matricule->equipment="Hook Frame";
        $equipment_matricule->brand="-";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="3";
        $equipment_matricule->matricule="4659-1";
        $equipment_matricule->equipment="Hook Frame";
        $equipment_matricule->brand="-";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="4";
        $equipment_matricule->matricule="4659-2";
        $equipment_matricule->equipment="Hook Frame";
        $equipment_matricule->brand="-";
        $equipment_matricule ->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="5";
        $equipment_matricule->matricule="4659-3";
        $equipment_matricule->equipment="Hook Frame";
        $equipment_matricule->brand="-";
        $equipment_matricule ->save();

//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="infrastructures";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();
//---------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------
        $type_of_equipment=new TypeOfEquipment();
        $type_of_equipment->name="Nacelle";
        $type_of_equipment->categorie="Equipment";
        $type_of_equipment->save();

        $equipment_matricule = new EquipmentMatricule();
        $equipment_matricule->id_equipment="MLF001";
        $equipment_matricule->matricule="2113613";
        $equipment_matricule->equipment="Nacelle";
        $equipment_matricule->brand="Haulotte";
        $equipment_matricule ->save();
//---------------------------------------------------------------------------------------




        $nature_of_damage=new NatureOfDamage();
        $nature_of_damage->name="Machinery breakdown";
        $nature_of_damage->categorie="Equipment";
        $nature_of_damage->save();

        $nature_of_damage=new NatureOfDamage();
        $nature_of_damage->name="Glass breakage";
        $nature_of_damage->categorie="Equipment";
        $nature_of_damage->save();

        $nature_of_damage=new NatureOfDamage();
        $nature_of_damage->name="Damage to infrastructure";
        $nature_of_damage->categorie="Equipment";
        $nature_of_damage->save();



        $nature_of_damage=new NatureOfDamage();
        $nature_of_damage->name="Machinery breakdown";
        $nature_of_damage->categorie="Automobile";
        $nature_of_damage->save();

        $nature_of_damage=new NatureOfDamage();
        $nature_of_damage->name="Glass breakage";
        $nature_of_damage->categorie="Automobile";
        $nature_of_damage->save();

        $nature_of_damage=new NatureOfDamage();
        $nature_of_damage->name="Damage to infrastructure";
        $nature_of_damage->categorie="Automobile";
        $nature_of_damage->save();








































        $fonction=new Fonction();
        $fonction->name="Engineer";
        $fonction->department_id=$department->id;
        $fonction->save();

        $user=new User();
        $user->username="test";
        $user->lastName="abdous";
        $user->firstName="hamza";
        $user->email="test";
        $user->password="test";
        $user->phoneNumber="test";
        $user->fonction_id=$fonction->id;
        $user->save();

    }
}
