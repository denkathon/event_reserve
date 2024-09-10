import React, { useEffect, useState } from 'react';
import axios from 'axios';

const ExamplePage: React.FC = () => {
    return (
        <div>
            <h1>Example Page</h1>
            <p>This is an example page with some text.</p>
        </div>
    );
};

export default ExamplePage;

// interface Example {
//     id: string;
//     title: string;
//     description: string;
// }

// const ExamplePage: React.FC = () => {
//     const [examples, setExamples] = useState<Example[]>([]);

//     useEffect(() => {
//         axios.get('/api/examples')
//             .then(response => setExamples(response.data))
//             .catch(error => console.error(error));
//     }, []);

//     return (
//         <div>
//             <h1>Example Page</h1>
//             <ul>
//                 {examples.map(example => (
//                     <li key={example.id}>
//                         <h2>{example.title}</h2>
//                         <p>{example.description}</p>
//                     </li>
//                 ))}
//             </ul>
//         </div>
//     );
// }

// export default ExamplePage;
