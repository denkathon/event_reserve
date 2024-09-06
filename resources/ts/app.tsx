import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { Flex } from '@chakra-ui/react';
import Example from './components/Example';

const RouteContents = () => {
    return (
        <Routes>
            <Route path="/" element={<Example />} /> {/* Exampleページ */}
        </Routes>
    );
}

function App() {
    return (
        <Router>
            <Flex>
                <RouteContents />
            </Flex>
        </Router>
    );
}

// レンダリング部分
const root = ReactDOM.createRoot(document.getElementById('app')!);
root.render(<App />);
