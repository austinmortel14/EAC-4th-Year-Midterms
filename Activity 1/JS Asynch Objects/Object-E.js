// Online Javascript Editor for free
// Write, Edit and Run your Javascript code using JS Online Compiler

// Problem E. Use the same array and demonstrate a sample code using the filter() method on the array.

const students = [
    { name: "Martin", age: 22, course:"Business"},
    { name: "Bobby", age: 22, course:"Marketing"},
    { name: "Richard", age: 23, course:"Biochem"},
    { name: "Janelle", age: 22, course:"Law"},
    { name: "Marie", age: 23, course:"Petroleum Engineering"},
    ];
    
    const olderStudents = students.filter(student => student.age > 22);
    console.log(olderStudents);