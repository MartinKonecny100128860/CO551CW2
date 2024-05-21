<?php
// these three lines include necessary configuration, database connection, and functions files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// student details which will be seeded to the database. Each student is represented as an associative array
$students = [
    [
        'studentid' => '3105',
        'password' => password_hash('test', PASSWORD_DEFAULT),
        'dob' => '1998-05-31',
        'firstname' => 'Sabrina',
        'lastname' => 'Thompson',
        'house' => '6 Pine Close',
        'town' => 'Nelson',
        'county' => 'Lancashire',
        'country' => 'United Kingdom',
        'postcode' => 'BB9 5TX',
        'image_path' => 'student3.png' // Add the image path
    ],
    [
        'studentid' => '1702',
        'password' => password_hash('test', PASSWORD_DEFAULT),
        'dob' => '1997-02-17',
        'firstname' => 'Greg',
        'lastname' => 'Jenko',
        'house' => '20 High St',
        'town' => 'Manchester',
        'county' => 'Greater Manchester',
        'country' => 'United Kingdom',
        'postcode' => 'M14 4SS',
        'image_path' => 'student4.png' // Add the image path
    ],
    [
        'studentid' => '2307',
        'password' => password_hash('test', PASSWORD_DEFAULT),
        'dob' => '2002-07-23',
        'firstname' => 'Joey',
        'lastname' => 'Bezigher',
        'house' => '123 Baker Street',
        'town' => 'London',
        'county' => 'Greater London',
        'country' => 'United Kingdom',
        'postcode' => 'NW1 6XE',
        'image_path' => 'student2.png' // Add the image path
    ],
    [
        'studentid' => '0104',
        'password' => password_hash('test', PASSWORD_DEFAULT),
        'dob' => '2003-04-01',
        'firstname' => 'Nino',
        'lastname' => 'Perez',
        'house' => '45 King Street',
        'town' => 'Manchester',
        'county' => 'Greater Manchester',
        'country' => 'United Kingdom',
        'postcode' => 'M2 4LQ',
        'image_path' => 'student1.png' // Add the image path
    ],
    [
        'studentid' => '0505',
        'password' => password_hash('test', PASSWORD_DEFAULT),
        'dob' => '1999-05-05',
        'firstname' => 'Salma',
        'lastname' => 'Hayek',
        'house' => '67 High Street',
        'town' => 'Aylesbury',
        'county' => 'Buckinghamshire',
        'country' => 'United Kingdom',
        'postcode' => 'HP20 1SH',
        'image_path' => 'student5.png' // Add the image path
    ]
];

// This block of code loops through each student in an array. Creates an SQL INSERT query for the current student's details
foreach ($students as $student) {
    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image_path) VALUES (
        '{$student['studentid']}',
        '{$student['password']}',
        '{$student['dob']}',
        '{$student['firstname']}',
        '{$student['lastname']}',
        '{$student['house']}',
        '{$student['town']}',
        '{$student['county']}',
        '{$student['country']}',
        '{$student['postcode']}',
        '{$student['image_path']}'
    );";
    
    // Execute the SQL query and check if it was successful, dispalys either success message or an error message 
    if (mysqli_query($conn, $sql)) {
        echo "Record for student ID {$student['studentid']} inserted successfully.<br>";
    } else {
        echo "Error inserting record for student ID {$student['studentid']}: " . mysqli_error($conn) . "<br>";
    }
}

// closes data base connection
mysqli_close($conn);
?>

