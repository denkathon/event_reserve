import React, { useState } from 'react';
import ScheduleTable from '../components/ScheduleTable';
import ReservationModal from '../components/ReservationModal';

const SchedulePage: React.FC = () => {
  const currentWeek = ['2024-09-07', '2024-09-08', '2024-09-09', '2024-09-10', '2024-09-11', '2024-09-12', '2024-09-13'];
  const nextWeek = ['2024-09-14', '2024-09-15', '2024-09-16', '2024-09-17', '2024-09-18', '2024-09-19', '2024-09-20'];
  const [isModalOpen, setIsModalOpen] = useState(false);

  const handleCellClick = (day: string, time: string) => {
    console.log(`Clicked on ${day} at ${time}`);
    setIsModalOpen(true);
  };

  const handleCloseModal = () => {
    setIsModalOpen(false);
  };

  const handleReserve = () => {
    setIsModalOpen(false);
    // 予約フォームに遷移
    window.location.href = 'events';
  };

  const reservations = Array(12).fill(Array(7).fill(0));

  return (
    <div>
      <h1>今週のスケジュール</h1>
      <ScheduleTable weekDates={currentWeek} reservations={reservations} onCellClick={handleCellClick} />

      <h1>来週のスケジュール</h1>
      <ScheduleTable weekDates={nextWeek} reservations={reservations} onCellClick={handleCellClick} />

      <ReservationModal isOpen={isModalOpen} onClose={handleCloseModal} onReserve={handleReserve} />
    </div>
  );
};

export default SchedulePage;
