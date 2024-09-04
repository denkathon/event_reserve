import React from 'react';
import ReactDOM from 'react-dom/client';
import Example from './components/Example';

const rootElement = document.getElementById('app');

if (rootElement) {
    ReactDOM.createRoot(rootElement).render(<Example />);
}
