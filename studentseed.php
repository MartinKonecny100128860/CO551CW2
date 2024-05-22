<?php
// Include necessary configuration, database connection, and functions files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Function to read image file and return its binary data
function getImageData($imagePath, $conn) {
    // Read the image file
    $imageData = file_get_contents($imagePath);
    // Return binary data
    return mysqli_real_escape_string($conn, $imageData);
}

// Student details which will be seeded to the database. Each student is represented as an associative array
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

// Loop through each student in the array and insert their details into the database
foreach ($students as $student) {
    // Read image data
    $imageData = getImageData($student['image_path'], $conn);
    // Insert data into student table
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
        '{$imageData}'
    );";
    
    // Execute the SQL query and check if it was successful, displays either a success message or an error message 
    if (mysqli_query($conn, $sql)) {
        echo "<div style='text-align: center;'>Record for student ID {$student['studentid']} inserted successfully.</div><br>";
    } else {
        echo "<div style='text-align: center;'>Error inserting record for student ID {$student['studentid']}: " . mysqli_error($conn) . "</div><br>";
    }
}

// Close database connection
mysqli_close($conn);
?>
