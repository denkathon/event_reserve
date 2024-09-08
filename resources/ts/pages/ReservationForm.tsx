import React, { useEffect, useState } from 'react';
import { useHistory } from 'react-router-dom';
import axios from 'axios';

const ReservationForm: React.FC = () => {
  const [name, setName] = useState('');
  const [information, setInformation] = useState('');
  const [start_at, setStart_at] = useState('');
  const [end_at, setEnd_at] = useState('');
  const history = useHistory();

  const handleSubmit = (e) => {
    e.preventDefault();
    // API call to store event (you will implement this)
    history.push('/confirmation');
  };

  return (
    <form onSubmit={handleSubmit}>
    <div>
      <label>イベント名</label>
      <input type="text" value={name} onChange={(e) => setName(e.target.value)} />
    </div>
    <div>
      <label>詳細情報</label>
      <textarea value={information} onChange={(e) => setInformation(e.target.value)} />
    </div>
    <div>
      <label>開始時刻</label>
      <input type="dateTime" value={start_at} onChange={(e) => setStart_at(e.target.value)} />
    </div>
    <div>
      <label>終了時刻</label>
      <input type="dateTime" value={end_at} onChange={(e) => setEnd_at(e.target.value)} />
    </div>
    <button type="submit">次へ</button>
  </form>
  );
};

export default ReservationForm;

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
