<?php

namespace Database\Seeders;

use App\Models\Drug;
use App\Models\DrugVote;
use App\Models\User;
use Illuminate\Database\Seeder;

class ObatpediaSeeder extends Seeder
{
    /**
     * Seed Obatpedia with practical demo data.
     */
    public function run(): void
    {
        $drugs = [
            [
                'name' => 'Paracetamol',
                'generic_name' => 'Acetaminophen',
                'description' => 'Analgesic and antipyretic used for mild to moderate pain and fever.',
                'indication' => 'Fever, headache, musculoskeletal pain.',
                'dosage' => '500 mg every 6-8 hours as needed. Maximum 4 g/day.',
                'route' => 'Oral',
                'contraindication' => 'Severe liver disease and hypersensitivity to paracetamol.',
                'side_effects' => 'Nausea, rash, elevated liver enzymes in overdose.',
                'aliases' => ['Acetaminophen', 'PCM', 'Panadol'],
            ],
            [
                'name' => 'Amoxicillin',
                'generic_name' => 'Amoxicillin trihydrate',
                'description' => 'Broad-spectrum penicillin antibiotic.',
                'indication' => 'Bacterial respiratory, ENT, urinary, and skin infections.',
                'dosage' => '500 mg every 8 hours, adjust based on infection severity.',
                'route' => 'Oral',
                'contraindication' => 'Penicillin allergy.',
                'side_effects' => 'Diarrhea, rash, nausea.',
                'aliases' => ['Amox', 'Amoxil', 'Moxatag'],
            ],
            [
                'name' => 'Omeprazole',
                'generic_name' => 'Omeprazole',
                'description' => 'Proton pump inhibitor that reduces gastric acid secretion.',
                'indication' => 'GERD, gastritis, peptic ulcer disease.',
                'dosage' => '20 mg once daily before meal.',
                'route' => 'Oral',
                'contraindication' => 'Hypersensitivity to proton pump inhibitors.',
                'side_effects' => 'Headache, abdominal pain, diarrhea.',
                'aliases' => ['Losec', 'PPI Omeprazole'],
            ],
            [
                'name' => 'Ibuprofen',
                'generic_name' => 'Ibuprofen',
                'description' => 'Nonsteroidal anti-inflammatory drug for pain and inflammation.',
                'indication' => 'Dental pain, dysmenorrhea, mild arthritis, fever.',
                'dosage' => '200-400 mg every 6-8 hours after meals.',
                'route' => 'Oral',
                'contraindication' => 'Active peptic ulcer, severe renal impairment, NSAID hypersensitivity.',
                'side_effects' => 'Gastric irritation, dizziness, fluid retention.',
                'aliases' => ['Brufen', 'Advil', 'Motrin'],
            ],
            [
                'name' => 'Cefixime',
                'generic_name' => 'Cefixime',
                'description' => 'Third-generation cephalosporin antibiotic.',
                'indication' => 'Upper and lower respiratory tract bacterial infections.',
                'dosage' => '200 mg twice daily.',
                'route' => 'Oral',
                'contraindication' => 'Cephalosporin allergy.',
                'side_effects' => 'Nausea, diarrhea, abdominal discomfort.',
                'aliases' => ['Suprax', 'Cefspan'],
            ],
            [
                'name' => 'Metformin',
                'generic_name' => 'Metformin hydrochloride',
                'description' => 'Biguanide oral antidiabetic agent.',
                'indication' => 'Type 2 diabetes mellitus.',
                'dosage' => '500 mg once or twice daily with meals, titrate gradually.',
                'route' => 'Oral',
                'contraindication' => 'Severe renal dysfunction and metabolic acidosis.',
                'side_effects' => 'Nausea, diarrhea, abdominal bloating.',
                'aliases' => ['Glucophage', 'Met XR'],
            ],
            [
                'name' => 'Amlodipine',
                'generic_name' => 'Amlodipine besylate',
                'description' => 'Calcium channel blocker antihypertensive.',
                'indication' => 'Hypertension and chronic stable angina.',
                'dosage' => '5-10 mg once daily.',
                'route' => 'Oral',
                'contraindication' => 'Known hypersensitivity to dihydropyridines.',
                'side_effects' => 'Peripheral edema, flushing, palpitations.',
                'aliases' => ['Norvasc'],
            ],
            [
                'name' => 'Captopril',
                'generic_name' => 'Captopril',
                'description' => 'ACE inhibitor for blood pressure and heart failure management.',
                'indication' => 'Hypertension, heart failure, diabetic nephropathy.',
                'dosage' => '12.5-25 mg two to three times daily.',
                'route' => 'Oral',
                'contraindication' => 'History of angioedema related to ACE inhibitor therapy.',
                'side_effects' => 'Dry cough, hypotension, hyperkalemia.',
                'aliases' => ['Capoten'],
            ],
            [
                'name' => 'Furosemide',
                'generic_name' => 'Furosemide',
                'description' => 'Loop diuretic for fluid overload states.',
                'indication' => 'Edema in heart failure, renal disease, hepatic disease.',
                'dosage' => '20-40 mg once or twice daily.',
                'route' => 'Oral',
                'contraindication' => 'Anuria and severe electrolyte depletion.',
                'side_effects' => 'Hypokalemia, dehydration, hypotension.',
                'aliases' => ['Lasix'],
            ],
            [
                'name' => 'Salbutamol',
                'generic_name' => 'Albuterol',
                'description' => 'Short-acting beta-2 agonist bronchodilator.',
                'indication' => 'Acute bronchospasm in asthma and COPD.',
                'dosage' => '2 puffs every 4-6 hours as needed.',
                'route' => 'Inhalation',
                'contraindication' => 'Hypersensitivity to salbutamol.',
                'side_effects' => 'Tremor, tachycardia, nervousness.',
                'aliases' => ['Ventolin', 'Albuterol'],
            ],
            [
                'name' => 'Loratadine',
                'generic_name' => 'Loratadine',
                'description' => 'Second-generation antihistamine with low sedation effect.',
                'indication' => 'Allergic rhinitis and urticaria.',
                'dosage' => '10 mg once daily.',
                'route' => 'Oral',
                'contraindication' => 'Hypersensitivity to loratadine.',
                'side_effects' => 'Headache, dry mouth, fatigue.',
                'aliases' => ['Claritin'],
            ],
            [
                'name' => 'Cetirizine',
                'generic_name' => 'Cetirizine hydrochloride',
                'description' => 'Second-generation antihistamine for allergic symptoms.',
                'indication' => 'Allergic rhinitis and chronic urticaria.',
                'dosage' => '10 mg once daily.',
                'route' => 'Oral',
                'contraindication' => 'Hypersensitivity to cetirizine or hydroxyzine.',
                'side_effects' => 'Drowsiness, dry mouth, dizziness.',
                'aliases' => ['Zyrtec'],
            ],
            [
                'name' => 'Domperidone',
                'generic_name' => 'Domperidone',
                'description' => 'Peripheral dopamine antagonist antiemetic and prokinetic.',
                'indication' => 'Nausea, vomiting, gastric motility disorders.',
                'dosage' => '10 mg up to three times daily before meals.',
                'route' => 'Oral',
                'contraindication' => 'Prolonged QT interval and severe hepatic impairment.',
                'side_effects' => 'Dry mouth, abdominal cramps, headache.',
                'aliases' => ['Motilium'],
            ],
            [
                'name' => 'Ondansetron',
                'generic_name' => 'Ondansetron hydrochloride',
                'description' => '5-HT3 antagonist antiemetic.',
                'indication' => 'Prevention and treatment of nausea and vomiting.',
                'dosage' => '4-8 mg every 8-12 hours as needed.',
                'route' => 'Oral/IV',
                'contraindication' => 'Concomitant apomorphine use.',
                'side_effects' => 'Headache, constipation, QT prolongation.',
                'aliases' => ['Zofran'],
            ],
            [
                'name' => 'Ranitidine',
                'generic_name' => 'Ranitidine hydrochloride',
                'description' => 'Histamine H2 receptor antagonist for acid suppression.',
                'indication' => 'Gastric acid-related disorders.',
                'dosage' => '150 mg twice daily.',
                'route' => 'Oral',
                'contraindication' => 'Hypersensitivity to ranitidine.',
                'side_effects' => 'Headache, constipation, nausea.',
                'aliases' => ['Zantac'],
            ],
            [
                'name' => 'Simvastatin',
                'generic_name' => 'Simvastatin',
                'description' => 'HMG-CoA reductase inhibitor for dyslipidemia.',
                'indication' => 'Hypercholesterolemia and cardiovascular risk reduction.',
                'dosage' => '10-40 mg once daily at night.',
                'route' => 'Oral',
                'contraindication' => 'Active liver disease and pregnancy.',
                'side_effects' => 'Myalgia, elevated liver enzymes, GI discomfort.',
                'aliases' => ['Zocor'],
            ],
            [
                'name' => 'Atorvastatin',
                'generic_name' => 'Atorvastatin calcium',
                'description' => 'Statin used to lower LDL cholesterol.',
                'indication' => 'Dyslipidemia and prevention of cardiovascular events.',
                'dosage' => '10-80 mg once daily.',
                'route' => 'Oral',
                'contraindication' => 'Active liver disease and pregnancy.',
                'side_effects' => 'Myalgia, transaminase elevation, dyspepsia.',
                'aliases' => ['Lipitor'],
            ],
            [
                'name' => 'Clopidogrel',
                'generic_name' => 'Clopidogrel bisulfate',
                'description' => 'Antiplatelet agent for thrombotic event prevention.',
                'indication' => 'Post-ACS, post-stent, stroke prevention.',
                'dosage' => '75 mg once daily.',
                'route' => 'Oral',
                'contraindication' => 'Active pathological bleeding.',
                'side_effects' => 'Bleeding, rash, dyspepsia.',
                'aliases' => ['Plavix'],
            ],
            [
                'name' => 'Aspirin',
                'generic_name' => 'Acetylsalicylic acid',
                'description' => 'Antiplatelet and analgesic medication.',
                'indication' => 'Cardiovascular prophylaxis, pain, and fever.',
                'dosage' => '80-100 mg daily for antiplatelet effect.',
                'route' => 'Oral',
                'contraindication' => 'Active bleeding, severe aspirin allergy.',
                'side_effects' => 'GI irritation, bleeding risk, tinnitus at high doses.',
                'aliases' => ['ASA', 'Aspilet'],
            ],
            [
                'name' => 'Dexamethasone',
                'generic_name' => 'Dexamethasone sodium phosphate',
                'description' => 'Potent corticosteroid anti-inflammatory and immunosuppressant.',
                'indication' => 'Severe inflammation, allergic reactions, cerebral edema.',
                'dosage' => '0.5-10 mg daily depending on indication.',
                'route' => 'Oral/IV',
                'contraindication' => 'Systemic fungal infection without treatment.',
                'side_effects' => 'Hyperglycemia, mood changes, fluid retention.',
                'aliases' => ['Dexa'],
            ],
            [
                'name' => 'Methylprednisolone',
                'generic_name' => 'Methylprednisolone',
                'description' => 'Corticosteroid for inflammatory and autoimmune conditions.',
                'indication' => 'Allergic reactions, asthma exacerbation, autoimmune flare.',
                'dosage' => '4-48 mg daily based on severity.',
                'route' => 'Oral/IV',
                'contraindication' => 'Systemic fungal infection.',
                'side_effects' => 'Hyperglycemia, insomnia, GI upset.',
                'aliases' => ['Medrol'],
            ],
            [
                'name' => 'Insulin Glargine',
                'generic_name' => 'Insulin glargine',
                'description' => 'Long-acting basal insulin analog.',
                'indication' => 'Type 1 and type 2 diabetes requiring basal insulin.',
                'dosage' => 'Once daily at same time, dose individualized.',
                'route' => 'Subcutaneous',
                'contraindication' => 'Hypoglycemia episodes at administration time.',
                'side_effects' => 'Hypoglycemia, injection site reactions, weight gain.',
                'aliases' => ['Lantus', 'Basal Insulin'],
            ],
        ];

        $seededDrugs = collect($drugs)->map(function (array $drugData) {
            $aliases = $drugData['aliases'];
            unset($drugData['aliases']);

            $drug = Drug::query()->updateOrCreate(
                ['name' => $drugData['name']],
                $drugData
            );

            $drug->aliases()->delete();

            foreach ($aliases as $alias) {
                $drug->aliases()->create(['alias' => $alias]);
            }

            return $drug;
        });

        $users = User::query()->take(20)->get();

        if ($users->count() < 12) {
            for ($i = 1; $i <= 12; $i++) {
                $users->push(User::query()->firstOrCreate(
                    ['email' => 'community'.$i.'@example.com'],
                    [
                        'name' => 'Community User '.$i,
                        'password' => bcrypt('password'),
                    ]
                ));
            }

            $users = $users->unique('id')->values();
        }

        foreach ($seededDrugs as $drug) {
            $voterCount = min($users->count(), random_int(5, 14));

            foreach ($users->shuffle()->take($voterCount) as $user) {
                $vote = random_int(1, 100) <= 70 ? DrugVote::VOTE_UP : DrugVote::VOTE_DOWN;

                DrugVote::query()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'drug_id' => $drug->id,
                    ],
                    [
                        'vote' => $vote,
                    ]
                );
            }
        }
    }
}
