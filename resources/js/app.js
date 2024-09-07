import React from 'react';
import ReactDOM from 'react-dom';

function App() {
    return (
        <div>
            <h1>React Laravel Integration</h1>
        </div>
    );
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}

