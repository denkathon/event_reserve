import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import TopPage from './pages/TopPage';
import Header from './components/Header';
import EventSpaceList from './pages/EventSpacePage';
import axios from 'axios';

const App: React.FC = () => {
    const [isAuthenticated, setIsAuthenticated] = useState<boolean | null>(null);

    useEffect(() => {
        const checkAuthStatus = async () => {
            try {
                const token = localStorage.getItem('auth_token');
                if (token) {
                    await axios.get(`/api/me`, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });
                    setIsAuthenticated(true);
                } else {
                    setIsAuthenticated(false);
                }
            } catch (error) {
                console.error('認証状態の確認に失敗しました:', error);
                setIsAuthenticated(false);
            }
        };
        checkAuthStatus();
    }, []);

    if (isAuthenticated === null) {
        return <div>Loading...</div>; // 認証状態確認中
    }

    return (
        <Router>
            <div>
                {isAuthenticated ? <Header /> : null}
                <Routes>
                    <Route
                        path="/"
                        element={isAuthenticated ? <TopPage /> : <Navigate to="/login" />}
                    />
                    <Route
                        path="/eventspaces"
                        element={isAuthenticated ? <EventSpaceList /> : <Navigate to="/login" />}
                    />
                    <Route
                        path="/login"
                        element={!isAuthenticated ? <LoginPage /> :  <Navigate to="/login" />}
                    />
                    <Route
                        path="/register"
                        element={!isAuthenticated ? <RegisterPage /> : <Navigate to="/login" />}
                    />
                    <Route path="*" element={<Navigate to={isAuthenticated ? "/" : "/login"} />} />
                </Routes>
            </div>
        </Router>
    );
};

const root = ReactDOM.createRoot(document.getElementById('app')!);
root.render(<App />);
