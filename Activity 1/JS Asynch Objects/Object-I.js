// Online Javascript Editor for free
// Write, Edit and Run your Javascript code using JS Online Compiler

// Problem I. Use the same array and demonstrate a sample code using the every() method on the array.

const students = [
    { name: "Martin", age: 22, course:"Business"},
    { name: "Bobby", age: 22, course:"Marketing"},
    { name: "Richard", age: 23, course:"Biochem"},
    { name: "Janelle", age: 22, course:"Law"},
    { name: "Marie", age: 23, course:"Petroleum Engineering"},
    ];
    
    const allAdults = students.every(student => student.age >= 18);
    console.log("All students are adults:", allAdults);