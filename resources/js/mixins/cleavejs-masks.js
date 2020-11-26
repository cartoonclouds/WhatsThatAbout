// Runtime ##h ##m ##s
new Cleave('.input-runtime', {
    time: true,
    timePattern: ['h', 'm', 's']
});

// Date
new Cleave('.input-date', {
    date: true,
    datePattern: ['Y', 'm', 'd'],
});

// Year
new Cleave('.input-year', {
    date: true,
    datePattern: ['Y'],
});

